<?php

namespace Ertuo\Lab\Tests;

use Ertuo\Lab\Benchmark_Bitbucket_FastRoute_GroupCountBased;

class Benchmark_Bitbucket_FastRoute_GroupCountBased_Test extends Benchmark_Bitbucket_Test
{
	function testBenchmark()
	{
		return $this->benchmark( new Benchmark_Bitbucket_FastRoute_GroupCountBased );
	}
}
