<?php

namespace Ertuo\Lab;

use Ertuo\Dispatcher;
use Ertuo\RouteAbstract;
use Ertuo\UnfoldedRoute;
use Ertuo\Lab\Benchmark_Bitbucket\Benchmark_Ertuo;
use Ertuo\Lab\Benchmark_Bitbucket_Ertuo_Array;

use function file_put_contents;
use function is_file;

/**
* @Revs(4000)
* @Iterations(5)
*/
class Benchmark_Bitbucket_Ertuo_Unfolded extends Benchmark_Ertuo
{
	protected $unfoldedRoutesFilename;

	function __construct()
	{
		$this->unfoldedRoutesFilename = __DIR__
			. '/Benchmark_Bitbucket/routes'
			. '/ertuo_unfolded_routes.php';

		if (!is_file($this->unfoldedRoutesFilename))
		{
			file_put_contents(
				$this->unfoldedRoutesFilename,
				'<?php return '
					. var_export((new Benchmark_Bitbucket_Ertuo_Array)
						->loadRoutes()
						->toArray(), 1)
					. ';'
			);
		}
	}

	function loadRoutes() : RouteAbstract
	{
		return UnfoldedRoute::fromArray(include $this->unfoldedRoutesFilename);
	}
}
