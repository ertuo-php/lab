<?php

namespace Ertuo\Lab\Open\FastRoute;

use Ertuo\Dispatcher;
use Ertuo\Kit;
use Ertuo\Result;
use Ertuo\UnfoldedRoute;
use Ertuo\Lab\Open\FastRoute\ErtuoDataGenerator;
use FastRoute\Dispatcher as FastRouteDispatcherInterface;
use FastRoute\RouteCollector;
use FastRoute\RouteParser\Std as RouteParser;
use RuntimeException;

use function chmod;
use function dirname;
use function file_put_contents;
use function is_dir;
use function is_writable;
use function mkdir;
use function rename;
use function restore_error_handler;
use function set_error_handler;
use function var_export;

use const LOCK_EX;

class ErtuoDispatcher implements FastRouteDispatcherInterface
{
	private const DIRECTORY_PERMISSIONS = 0775;
	private const FILE_PERMISSIONS = 0664;

	protected $dispatcher;

	protected $routes;

	protected $routeTreeFile;

	/**
	* @param callable $routeDefinitionCallback
	* @param array $options
	*
	* @return self
	*/
	static function createDispatcher(callable $routeDefinitionCallback, array $options = [])
	{
		$options += [
			'routeParser' => RouteParser::class,
			'routeCollector' => RouteCollector::class,
			'routeTreeFile' => '/tmp/'
				. md5( (new \Exception)->getTraceAsString() )
				. '.php',
			];
		// print_r($options);

		// tree already present ?
		//
		$dispatcher = new self;
		if ($dispatcher->loadRoutes($options['routeTreeFile']))
		{
			return $dispatcher;
		}

		// rebuild tree
		//
		$routeCollector = new $options['routeCollector'](
			new $options['routeParser'],
			new ErtuoDataGenerator
			);
		$routeDefinitionCallback($routeCollector);

		$tree = $routeCollector->getData();
		$dispatcher->routes = UnfoldedRoute::fromArray( $tree );
		$dispatcher->routeTreeFile = $options['routeTreeFile'];

		return $dispatcher;
	}

	protected function loadRoutes($routeTreeFile)
	{
		// [quote from FastRoute]: error suppression is faster than
		// calling `file_exists()` + `is_file()` + `is_readable()`,
		// especially because there's no need to error here
		//
		set_error_handler(static function() {});
		$tree = include $routeTreeFile;
		restore_error_handler();

		if ($tree)
		{
			$this->routes = UnfoldedRoute::fromArray( $tree );
			return true;
		}

		return false;
	}

	function __destruct()
	{
		if (!empty($this->routeTreeFile))
		{
			$this->writeRoutes(
				$this->routeTreeFile,
				$this->routes->toArray()
			);
		}
	}

	protected function writeRoutes($routeTreeFile, $tree)
	{
		$directory = dirname($routeTreeFile);

		if (!is_dir($directory))
		{
			if (!mkdir($directory, self::DIRECTORY_PERMISSIONS, true))
			{
				throw new RuntimeException(
					"Unable to create directory: {$directory}"
				);
			}
		}

		if (!is_writable($directory))
		{
			throw new RuntimeException(
				"Directory not writable: {$directory}"
			);
		}

		$tmpFile = $routeTreeFile . '.tmp';

		$php = '<?php'
			. "\n"
			. "\n" . 'return ' . var_export($tree, 1) . ';'
			. "\n";

		if (false === file_put_contents($tmpFile, $php, LOCK_EX))
		{
			throw new RuntimeException(
				"Unable to write file: {$tmpFile}"
			);
		}

		chmod($tmpFile, self::FILE_PERMISSIONS);

		if (!rename($tmpFile, $routeTreeFile))
		{
			throw new RuntimeException(
				"Unable to rename {$tmpFile} to {$routeTreeFile}"
			);
		}
	}

	function dispatch($httpMethod, $uri)
	{
		if (empty($this->dispatcher))
		{
			$this->dispatcher = new Dispatcher($this->routes);
		}

		$source = Kit::quickExplode($uri);
		$result = $this->dispatcher->dispatch($source);

		// print_r($result);

		$attributes = $result->attributes;
		if (!empty($attributes[ $httpMethod ])
			|| ('HEAD' == $httpMethod
				&& !empty($attributes[ 'GET' ])
				&& $httpMethod = 'GET'))
		{
			$handler = $attributes[ $httpMethod ];

			unset($attributes[ 'GET' ]);
			unset($attributes[ 'POST' ]);
			unset($attributes[ 'PUT' ]);
			unset($attributes[ 'DELETE' ]);
			unset($attributes[ 'HEAD' ]);
			unset($attributes[ 'OPTIONS' ]);

			return [self::FOUND, $handler, $attributes];
		}

		$allowedMethods = array();
		foreach ($attributes as $key => $value)
		{
			if (in_array($key, array(
				'GET', 'HEAD', 'POST',
				'PUT', 'DELETE', 'OPTIONS')))
			{
				$allowedMethods[] = $key;
			}
		}

		if ($allowedMethods)
		{
			return [self::METHOD_NOT_ALLOWED, $allowedMethods];
		}

        	return [self::NOT_FOUND];
	}
}
