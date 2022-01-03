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

To compare results run the two Ertuo benchmarks, one using generators to declare the routes, and another one using just plain arrays.
```
php vendor/bin/phpbench run lab/Benchmark_Bitbucket_Ertuo_Generator.php --report=short
php vendor/bin/phpbench run lab/Benchmark_Bitbucket_Ertuo_Array.php --report=short
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
Benchmark_Bitbucket_Ertuo_Array
+--------------+----------+----------+----------+----------+---------+--------+
| subject      | best     | mean     | mode     | worst    | stdev   | rstdev |
+--------------+----------+----------+----------+----------+---------+--------+
| benchSetup   | 2.653μs  | 3.003μs  | 2.889μs  | 3.548μs  | 0.298μs | ±9.93% |
| benchLast    | 24.995μs | 25.650μs | 25.853μs | 26.183μs | 0.446μs | ±1.74% |
| benchLongest | 48.468μs | 49.466μs | 49.003μs | 50.710μs | 0.821μs | ±1.66% |
| benchTotal   | 33.890μs | 34.835μs | 35.067μs | 35.805μs | 0.687μs | ±1.97% |
+--------------+----------+----------+----------+----------+---------+--------+

Benchmark_Bitbucket_FastRoute_Cached_MarkBased
+--------------+----------+----------+----------+----------+---------+--------+
| subject      | best     | mean     | mode     | worst    | stdev   | rstdev |
+--------------+----------+----------+----------+----------+---------+--------+
| benchSetup   | 5.483μs  | 6.116μs  | 5.903μs  | 7.008μs  | 0.519μs | ±8.48% |
| benchLast    | 22.915μs | 24.745μs | 24.182μs | 26.963μs | 1.407μs | ±5.69% |
| benchLongest | 22.395μs | 23.961μs | 24.630μs | 25.265μs | 1.127μs | ±4.71% |
| benchTotal   | 22.745μs | 24.463μs | 23.298μs | 29.173μs | 2.395μs | ±9.79% |
+--------------+----------+----------+----------+----------+---------+--------+

Benchmark_Bitbucket_Symfony_Compiled
+--------------+-----------+-----------+-----------+-----------+----------+--------+
| subject      | best      | mean      | mode      | worst     | stdev    | rstdev |
+--------------+-----------+-----------+-----------+-----------+----------+--------+
| benchSetup   | 686.550μs | 713.150μs | 694.967μs | 755.925μs | 27.400μs | ±3.84% |
| benchLast    | 747.500μs | 757.693μs | 751.065μs | 774.690μs | 10.610μs | ±1.40% |
| benchLongest | 738.705μs | 764.282μs | 767.293μs | 786.445μs | 16.246μs | ±2.13% |
| benchTotal   | 723.003μs | 775.095μs | 768.457μs | 818.983μs | 35.134μs | ±4.53% |
+--------------+-----------+-----------+-----------+-----------+----------+--------+
```

#### PHP 8.0

```
Benchmark_Bitbucket_Ertuo_Array
+--------------+----------+----------+----------+----------+---------+--------+
| subject      | best     | mean     | mode     | worst    | stdev   | rstdev |
+--------------+----------+----------+----------+----------+---------+--------+
| benchSetup   | 4.100μs  | 4.316μs  | 4.226μs  | 4.625μs  | 0.185μs | ±4.29% |
| benchLast    | 36.423μs | 39.722μs | 40.401μs | 41.888μs | 1.813μs | ±4.56% |
| benchLongest | 70.518μs | 74.429μs | 73.650μs | 79.510μs | 2.968μs | ±3.99% |
| benchTotal   | 51.593μs | 54.939μs | 52.502μs | 64.505μs | 4.919μs | ±8.95% |
+--------------+----------+----------+----------+----------+---------+--------+

Benchmark_Bitbucket_FastRoute_Cached_MarkBased
+--------------+----------+----------+----------+----------+---------+---------+
| subject      | best     | mean     | mode     | worst    | stdev   | rstdev  |
+--------------+----------+----------+----------+----------+---------+---------+
| benchSetup   | 8.965μs  | 9.313μs  | 9.184μs  | 9.720μs  | 0.275μs | ±2.96%  |
| benchLast    | 33.370μs | 35.009μs | 34.709μs | 36.935μs | 1.310μs | ±3.74%  |
| benchLongest | 32.355μs | 35.178μs | 33.247μs | 42.960μs | 3.957μs | ±11.25% |
| benchTotal   | 33.383μs | 35.412μs | 35.020μs | 38.030μs | 1.571μs | ±4.44%  |
+--------------+----------+----------+----------+----------+---------+---------+

Benchmark_Bitbucket_Symfony_Compiled
+--------------+-----------+-----------+-----------+-----------+----------+--------+
| subject      | best      | mean      | mode      | worst     | stdev    | rstdev |
+--------------+-----------+-----------+-----------+-----------+----------+--------+
| benchSetup   | 759.070μs | 769.168μs | 774.045μs | 777.118μs | 7.375μs  | ±0.96% |
| benchLast    | 817.133μs | 829.218μs | 823.967μs | 850.080μs | 11.404μs | ±1.38% |
| benchLongest | 806.370μs | 824.142μs | 813.049μs | 868.420μs | 22.899μs | ±2.78% |
| benchTotal   | 804.215μs | 819.526μs | 823.862μs | 829.128μs | 8.825μs  | ±1.08% |
+--------------+-----------+-----------+-----------+-----------+----------+--------+
```

### Comparing with Fully Unfolded Tree

One assumption I wanted to benchmark was if the routing process will be quicker if we start with a fully unfolded tree instead of progressively exploring it at runtime.

To test this I've added two more `Route` classes that use the output from `Route::toArray()` as their route definitions. Both classes are slightly different in how they move down the routes tree with one using references and the other creating new objects.
```
php vendor/bin/phpbench run lab/Benchmark_Bitbucket_Ertuo_UnfoldedTree_Copy.php --report=short
php vendor/bin/phpbench run lab/Benchmark_Bitbucket_Ertuo_UnfoldedTree_Ref.php --report=short
```
