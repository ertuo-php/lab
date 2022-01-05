<?php

namespace Ertuo\Lab\Open\FastRoute;

use Ertuo\Kit;
use Ertuo\Route;
use FastRoute\DataGenerator as DataGeneratorInterface;

use function is_array;

class ErtuoDataGenerator implements DataGeneratorInterface
{
	const ROUTE = array(
		'key' => '',
		'attributes' => [],
		'rule' => ['', [], []],
		'default' => ['', []],
		'routes' => [],
		);

	protected $tree = self::ROUTE;

	function addRoute($httpMethod, $routeData, $handler)
	{
		// print_r($routeData);

		$steps = array();
		foreach ($routeData as $data)
		{
			if (is_array($data))
			{
				$steps[] = $data;
				continue;
			}

			$current = Kit::quickExplode($data);
			foreach ($current as $step)
			{
				$steps[] = array($step, '');
			}
		}

		$http = [ $httpMethod => $handler ];

		$path = array();
		$current =& $this->tree;
		foreach($steps as $step)
		{
			$path[] = $step;

			[$key, $regexp] = $step;

			if (!$regexp)
			{
				$current['routes'][ $key ] =
				$current['routes'][ $key ] ?? self::ROUTE;

				$current =& $current['routes'][ $key ];

				if ($path == $steps)
				{
					$current['attributes'] = $http;
				}

				continue;
			}

			$current['key'] = $key;

			if (empty($current['rule'][0]))
			{
				$current['rule'] = ('[^/]+' == $regexp)
					? array('any', [], [])
					: array('regexp', [$regexp], []);
			}

			if ($path == $steps)
			{
				$current['rule'][2] += $http;
			} else
			{
				$current['routes'][ '' ] =
				$current['routes'][ '' ] ?? self::ROUTE;;

				$current =& $current['routes'][ '' ];
			}
		}
	}

	function getData()
	{
		return $this->tree;
	}
}
