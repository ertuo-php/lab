<?php

namespace Ertuo\Lab;

use Ertuo\Lab\Benchmark_Bitbucket\Benchmark_FastRoute;
use Ertuo\Lab\Open\FastRoute\ErtuoDispatcher;

class Benchmark_Bitbucket_FastRoute_Ertuo_Open extends Benchmark_FastRoute
{
	function setupRouting()
	{
		return ErtuoDispatcher::createDispatcher(
			[$this, 'loadedRoutes'],
			['routeTreeFile' => __DIR__
				. '/Benchmark_Bitbucket/routes'
				. '/ertuo_fastroute_routes.php']
		);
	}

	function runRouting($route) : array
	{
		$dispatcher = $this->setupRouting();

		$match = $dispatcher->dispatch('GET', $route);
		return array('_route' => $match[1]) + $match[2];
	}
}
