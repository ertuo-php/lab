# Ertuo Lab: Benchmarks and Experiments

Benchmarks and Experiments for the [Ertuo](https://github.com/ertuo-php) project.

# Bitbucket API Benchmarks

The benchmarks are based on [phpbench](https://github/phpbench/phpbench) and are inside the "lab/" folder. The setup is similar to [benchmark-php-routing](https://github.com/kktsvetkov/benchmark-php-routing) and it is also using the **Bitbucket API** routes to compose a somewhat real-world benchmark.

The routes are in [bitbucket-api.txt](lab/Benchmark_Bitbucket/bitbucket-api.txt) and this file is used to compose the benchmarks. Only the routes are used, with the HTTP verbs/methods being ignored. The benchmarks are only to match the full routes, with all the params extracted from the routes ignored as well.

There are also tests for all of the Bitbucket API benchmarks to make it easier to check if the results they deliver are consistent.

The benchmarks executed are three:

* `benchLast` that tries to match the last route from the list
* `benchLongest` that tries to match the longest route from the list
* `benchTotal` that tries to match every single route from the list

For regular expression based routing the `benchLast` should be slowest one. This is because that is the worst case for that approach as it iterates over the routes until a match is found. Compiled routes significantly reduces the number of routes to check, but more or less the process is the same and the list of routes is checked one by one until a match is found. In other words, as the route collection grows, the slower the regular expression routing gets.

For a step based routing process like Ertuo the `benchLongest` must be the slowest. This is because the deeper you go then a route will have more steps to traverse. In other words, as the route length grows in terms of steps, the slower the step based routing gets as it has more steps to inspect.

The `benchTotal` is just to get an overall average measurement for routing to all of the routes from the list.

There is one additional benchmark added, that is called `benchSetup`. It is used to provide a baseline to compare all of the routing benchmarks against it, as it only tracks how much time is spent to setup the process before the actual routing. The setup is usually just loading up the route collection.

Compare the results from this benchmark if you want to monitor how much time is spent on the setup part of the routing and how time does the real dispatching takes. My observations are that for conventional routing libraries such as Symfony Routing and FastRoute the fully loaded route collection from the setup takes way too much time compared to the actual dispatching.

### Comparing with Symfony Routing and FastRoute

I've added the same benchmarks with Symfony Routing and FastRoute as I did in https://github.com/kktsvetkov/benchmark-php-routing:

* two Symfony Routing based benchmarks, one using the regular setup, and one using a compiled version of all of the routes.
```
php vendor/bin/phpbench run lab/Benchmark_Bitbucket_Symfony.php --report=short
php vendor/bin/phpbench run lab/Benchmark_Bitbucket_Symfony_Compiled.php --report=short
```

* eight FastRoute based benchmarks, 4 regular ones using different strategies and 4 more where the same strategies are cached
```
php vendor/bin/phpbench run Benchmark_Bitbucket_FastRoute_CharCountBased.php --report=short
php vendor/bin/phpbench run Benchmark_Bitbucket_FastRoute_GroupCountBased.php --report=short
php vendor/bin/phpbench run Benchmark_Bitbucket_FastRoute_GroupPosBased.php --report=short
php vendor/bin/phpbench run Benchmark_Bitbucket_FastRoute_MarkBased.php --report=short
php vendor/bin/phpbench run Benchmark_Bitbucket_FastRoute_Cached_CharCountBased.php --report=short
php vendor/bin/phpbench run Benchmark_Bitbucket_FastRoute_Cached_GroupCountBased.php --report=short
php vendor/bin/phpbench run Benchmark_Bitbucket_FastRoute_Cached_GroupPosBased.php --report=short
php vendor/bin/phpbench run Benchmark_Bitbucket_FastRoute_Cached_MarkBased.php --report=short
```

To compare results run the Ertuo benchmarks, one using generators to declare
the routes, another one using just plain arrays and finally one with unfolded routes.
```
php vendor/bin/phpbench run lab/Benchmark_Bitbucket_Ertuo_Generator.php --report=short
php vendor/bin/phpbench run lab/Benchmark_Bitbucket_Ertuo_Array.php --report=short
php vendor/bin/phpbench run lab/Benchmark_Bitbucket_Ertuo_Unfolded.php --report=short
```

### Benchmark Results

I am comparing it to the best of both breeds: Symfony Compiled routes and FastRoute Cached MarkBased strategy.

You can see the results in the logs of the Github ["benchmark.yml"](https://github.com/ertuo-php/ertuo/actions/workflows/benchmark.yml) action as well.

```sh
PHPBench (1.2.3) running benchmarks...
with configuration file: /home/runner/work/ertuo/ertuo/phpbench.json
with PHP version 7.4.26, xdebug ???, opcache ???
```

#### PHP 7.4

```
Benchmark_Bitbucket_Ertuo_Unfolded
+--------------+----------+----------+----------+----------+---------+--------+
| subject      | best     | mean     | mode     | worst    | stdev   | rstdev |
+--------------+----------+----------+----------+----------+---------+--------+
| benchSetup   | 1.414??s  | 1.484??s  | 1.500??s  | 1.518??s  | 0.036??s | ??2.43% |
| benchLast    | 7.672??s  | 7.795??s  | 7.707??s  | 8.072??s  | 0.155??s | ??1.99% |
| benchLongest | 14.914??s | 15.440??s | 15.675??s | 15.748??s | 0.341??s | ??2.21% |
| benchTotal   | 8.838??s  | 9.375??s  | 9.230??s  | 10.121??s | 0.428??s | ??4.56% |
+--------------+----------+----------+----------+----------+---------+--------+
```
```
Benchmark_Bitbucket_FastRoute_Cached_MarkBased
+--------------+----------+----------+----------+----------+---------+--------+
| subject      | best     | mean     | mode     | worst    | stdev   | rstdev |
+--------------+----------+----------+----------+----------+---------+--------+
| benchSetup   | 6.495??s  | 6.856??s  | 6.990??s  | 7.140??s  | 0.243??s | ??3.54% |
| benchLast    | 24.535??s | 25.119??s | 25.298??s | 25.495??s | 0.361??s | ??1.44% |
| benchLongest | 23.875??s | 24.223??s | 23.958??s | 24.778??s | 0.374??s | ??1.54% |
| benchTotal   | 25.095??s | 25.740??s | 25.875??s | 26.153??s | 0.354??s | ??1.37% |
+--------------+----------+----------+----------+----------+---------+--------+
```
```
Benchmark_Bitbucket_Symfony_Compiled
+--------------+----------+----------+----------+----------+---------+---------+
| subject      | best     | mean     | mode     | worst    | stdev   | rstdev  |
+--------------+----------+----------+----------+----------+---------+---------+
| benchSetup   | 10.708??s | 11.714??s | 11.104??s | 12.888??s | 0.906??s | ??7.73%  |
| benchLast    | 32.765??s | 37.511??s | 34.700??s | 43.398??s | 4.177??s | ??11.13% |
| benchLongest | 32.358??s | 37.661??s | 33.555??s | 54.205??s | 8.303??s | ??22.05% |
| benchTotal   | 32.488??s | 34.399??s | 33.920??s | 36.870??s | 1.487??s | ??4.32%  |
+--------------+----------+----------+----------+----------+---------+---------+
```

#### PHP 8.0

```
Benchmark_Bitbucket_Ertuo_Unfolded
+--------------+----------+----------+----------+----------+---------+---------+
| subject      | best     | mean     | mode     | worst    | stdev   | rstdev  |
+--------------+----------+----------+----------+----------+---------+---------+
| benchSetup   | 1.672??s  | 1.836??s  | 1.920??s  | 2.011??s  | 0.140??s | ??7.60%  |
| benchLast    | 7.034??s  | 7.500??s  | 7.664??s  | 7.817??s  | 0.303??s | ??4.04%  |
| benchLongest | 14.012??s | 16.479??s | 16.034??s | 18.932??s | 1.718??s | ??10.43% |
| benchTotal   | 9.023??s  | 10.132??s | 9.839??s  | 11.748??s | 0.887??s | ??8.75%  |
+--------------+----------+----------+----------+----------+---------+---------+
```
```
Benchmark_Bitbucket_FastRoute_Cached_MarkBased
+--------------+----------+----------+----------+----------+---------+---------+
| subject      | best     | mean     | mode     | worst    | stdev   | rstdev  |
+--------------+----------+----------+----------+----------+---------+---------+
| benchSetup   | 6.958??s  | 7.964??s  | 7.534??s  | 9.453??s  | 0.883??s | ??11.08% |
| benchLast    | 31.823??s | 35.079??s | 34.415??s | 39.435??s | 2.724??s | ??7.77%  |
| benchLongest | 31.115??s | 34.052??s | 32.962??s | 38.210??s | 2.654??s | ??7.79%  |
| benchTotal   | 31.705??s | 34.923??s | 35.833??s | 37.073??s | 1.878??s | ??5.38%  |
+--------------+----------+----------+----------+----------+---------+---------+
```
```
Benchmark_Bitbucket_Symfony_Compiled
+--------------+----------+----------+----------+----------+---------+--------+
| subject      | best     | mean     | mode     | worst    | stdev   | rstdev |
+--------------+----------+----------+----------+----------+---------+--------+
| benchSetup   | 12.470??s | 12.525??s | 12.509??s | 12.595??s | 0.043??s | ??0.34% |
| benchLast    | 34.723??s | 34.859??s | 34.879??s | 35.020??s | 0.109??s | ??0.31% |
| benchLongest | 35.443??s | 35.645??s | 35.505??s | 36.205??s | 0.284??s | ??0.80% |
| benchTotal   | 35.640??s | 35.792??s | 35.701??s | 35.965??s | 0.135??s | ??0.38% |
+--------------+----------+----------+----------+----------+---------+--------+
```
