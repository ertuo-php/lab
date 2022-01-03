<?php

namespace Ertuo\Lab\Tests;

use Ertuo\Lab\Benchmark_Bitbucket_Symfony_Compiled;

class Benchmark_Bitbucket_Symfony_Test_Compiled extends Benchmark_Bitbucket_Test
{
	function testBenchmark()
	{
		return $this->benchmark( new Benchmark_Bitbucket_Symfony_Compiled );
	}
}
