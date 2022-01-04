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
with PHP version 7.4.26, xdebug ❌, opcache ✔
```

#### PHP 7.4

```
Benchmark_Bitbucket_Ertuo_Unfolded
+--------------+----------+----------+----------+----------+---------+--------+
| subject      | best     | mean     | mode     | worst    | stdev   | rstdev |
+--------------+----------+----------+----------+----------+---------+--------+
| benchSetup   | 1.414μs  | 1.484μs  | 1.500μs  | 1.518μs  | 0.036μs | ±2.43% |
| benchLast    | 7.672μs  | 7.795μs  | 7.707μs  | 8.072μs  | 0.155μs | ±1.99% |
| benchLongest | 14.914μs | 15.440μs | 15.675μs | 15.748μs | 0.341μs | ±2.21% |
| benchTotal   | 8.838μs  | 9.375μs  | 9.230μs  | 10.121μs | 0.428μs | ±4.56% |
+--------------+----------+----------+----------+----------+---------+--------+
```
```
Benchmark_Bitbucket_FastRoute_Cached_MarkBased
+--------------+----------+----------+----------+----------+---------+--------+
| subject      | best     | mean     | mode     | worst    | stdev   | rstdev |
+--------------+----------+----------+----------+----------+---------+--------+
| benchSetup   | 6.495μs  | 6.856μs  | 6.990μs  | 7.140μs  | 0.243μs | ±3.54% |
| benchLast    | 24.535μs | 25.119μs | 25.298μs | 25.495μs | 0.361μs | ±1.44% |
| benchLongest | 23.875μs | 24.223μs | 23.958μs | 24.778μs | 0.374μs | ±1.54% |
| benchTotal   | 25.095μs | 25.740μs | 25.875μs | 26.153μs | 0.354μs | ±1.37% |
+--------------+----------+----------+----------+----------+---------+--------+
```
```
Benchmark_Bitbucket_Symfony_Compiled
+--------------+----------+----------+----------+----------+---------+---------+
| subject      | best     | mean     | mode     | worst    | stdev   | rstdev  |
+--------------+----------+----------+----------+----------+---------+---------+
| benchSetup   | 10.708μs | 11.714μs | 11.104μs | 12.888μs | 0.906μs | ±7.73%  |
| benchLast    | 32.765μs | 37.511μs | 34.700μs | 43.398μs | 4.177μs | ±11.13% |
| benchLongest | 32.358μs | 37.661μs | 33.555μs | 54.205μs | 8.303μs | ±22.05% |
| benchTotal   | 32.488μs | 34.399μs | 33.920μs | 36.870μs | 1.487μs | ±4.32%  |
+--------------+----------+----------+----------+----------+---------+---------+
```

#### PHP 8.0

```
Benchmark_Bitbucket_Ertuo_Unfolded
+--------------+----------+----------+----------+----------+---------+---------+
| subject      | best     | mean     | mode     | worst    | stdev   | rstdev  |
+--------------+----------+----------+----------+----------+---------+---------+
| benchSetup   | 1.672μs  | 1.836μs  | 1.920μs  | 2.011μs  | 0.140μs | ±7.60%  |
| benchLast    | 7.034μs  | 7.500μs  | 7.664μs  | 7.817μs  | 0.303μs | ±4.04%  |
| benchLongest | 14.012μs | 16.479μs | 16.034μs | 18.932μs | 1.718μs | ±10.43% |
| benchTotal   | 9.023μs  | 10.132μs | 9.839μs  | 11.748μs | 0.887μs | ±8.75%  |
+--------------+----------+----------+----------+----------+---------+---------+
```
```
Benchmark_Bitbucket_FastRoute_Cached_MarkBased
+--------------+----------+----------+----------+----------+---------+---------+
| subject      | best     | mean     | mode     | worst    | stdev   | rstdev  |
+--------------+----------+----------+----------+----------+---------+---------+
| benchSetup   | 6.958μs  | 7.964μs  | 7.534μs  | 9.453μs  | 0.883μs | ±11.08% |
| benchLast    | 31.823μs | 35.079μs | 34.415μs | 39.435μs | 2.724μs | ±7.77%  |
| benchLongest | 31.115μs | 34.052μs | 32.962μs | 38.210μs | 2.654μs | ±7.79%  |
| benchTotal   | 31.705μs | 34.923μs | 35.833μs | 37.073μs | 1.878μs | ±5.38%  |
+--------------+----------+----------+----------+----------+---------+---------+
```
```
Benchmark_Bitbucket_Symfony_Compiled
+--------------+----------+----------+----------+----------+---------+--------+
| subject      | best     | mean     | mode     | worst    | stdev   | rstdev |
+--------------+----------+----------+----------+----------+---------+--------+
| benchSetup   | 12.470μs | 12.525μs | 12.509μs | 12.595μs | 0.043μs | ±0.34% |
| benchLast    | 34.723μs | 34.859μs | 34.879μs | 35.020μs | 0.109μs | ±0.31% |
| benchLongest | 35.443μs | 35.645μs | 35.505μs | 36.205μs | 0.284μs | ±0.80% |
| benchTotal   | 35.640μs | 35.792μs | 35.701μs | 35.965μs | 0.135μs | ±0.38% |
+--------------+----------+----------+----------+----------+---------+--------+
```
