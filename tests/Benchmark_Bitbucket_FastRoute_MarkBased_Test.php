<?php

namespace Ertuo\Lab\Tests;

use Ertuo\Lab\Benchmark_Bitbucket_FastRoute_MarkBased;

class Benchmark_Bitbucket_FastRoute_MarkBased_Test extends Benchmark_Bitbucket_Test
{
	function testBenchmark()
	{
		return $this->benchmark( new Benchmark_Bitbucket_FastRoute_MarkBased );
	}
}