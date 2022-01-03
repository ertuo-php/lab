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
| benchSetup   | 2.423μs  | 2.477μs  | 2.441μs  | 2.585μs  | 0.062μs | ±2.52% |
| benchLast    | 22.988μs | 23.082μs | 23.039μs | 23.263μs | 0.095μs | ±0.41% |
| benchLongest | 42.443μs | 42.740μs | 42.783μs | 42.973μs | 0.172μs | ±0.40% |
| benchTotal   | 31.208μs | 31.307μs | 31.292μs | 31.428μs | 0.071μs | ±0.23% |
+--------------+----------+----------+----------+----------+---------+--------+

Benchmark_Bitbucket_FastRoute_Cached_MarkBased
+--------------+----------+----------+----------+----------+---------+--------+
| subject      | best     | mean     | mode     | worst    | stdev   | rstdev |
+--------------+----------+----------+----------+----------+---------+--------+
| benchSetup   | 5.720μs  | 5.786μs  | 5.764μs  | 5.888μs  | 0.057μs | ±0.99% |
| benchLast    | 21.155μs | 21.434μs | 21.292μs | 22.020μs | 0.304μs | ±1.42% |
| benchLongest | 20.185μs | 20.546μs | 20.514μs | 20.960μs | 0.268μs | ±1.31% |
| benchTotal   | 21.705μs | 21.774μs | 21.737μs | 21.893μs | 0.071μs | ±0.33% |
+--------------+----------+----------+----------+----------+---------+--------+

Benchmark_Bitbucket_Symfony_Compiled
+--------------+----------+----------+----------+----------+---------+--------+
| subject      | best     | mean     | mode     | worst    | stdev   | rstdev |
+--------------+----------+----------+----------+----------+---------+--------+
| benchSetup   | 8.685μs  | 8.756μs  | 8.715μs  | 8.863μs  | 0.068μs | ±0.78% |
| benchLast    | 20.708μs | 20.797μs | 20.745μs | 21.000μs | 0.108μs | ±0.52% |
| benchLongest | 21.330μs | 21.517μs | 21.626μs | 21.665μs | 0.149μs | ±0.69% |
| benchTotal   | 21.008μs | 21.157μs | 21.237μs | 21.315μs | 0.130μs | ±0.61% |
+--------------+----------+----------+----------+----------+---------+--------+
```

#### PHP 8.0

```
Benchmark_Bitbucket_Ertuo_Array
+--------------+----------+----------+----------+----------+---------+--------+
| subject      | best     | mean     | mode     | worst    | stdev   | rstdev |
+--------------+----------+----------+----------+----------+---------+--------+
| benchSetup   | 4.283μs  | 4.422μs  | 4.324μs  | 4.588μs  | 0.134μs | ±3.02% |
| benchLast    | 37.338μs | 38.293μs | 37.585μs | 39.555μs | 0.975μs | ±2.55% |
| benchLongest | 63.938μs | 64.568μs | 64.233μs | 65.673μs | 0.634μs | ±0.98% |
| benchTotal   | 49.703μs | 50.232μs | 50.169μs | 50.805μs | 0.367μs | ±0.73% |
+--------------+----------+----------+----------+----------+---------+--------+

Benchmark_Bitbucket_FastRoute_Cached_MarkBased
+--------------+----------+----------+----------+----------+---------+--------+
| subject      | best     | mean     | mode     | worst    | stdev   | rstdev |
+--------------+----------+----------+----------+----------+---------+--------+
| benchSetup   | 8.225μs  | 8.432μs  | 8.472μs  | 8.595μs  | 0.124μs | ±1.47% |
| benchLast    | 32.183μs | 32.756μs | 32.407μs | 33.820μs | 0.614μs | ±1.87% |
| benchLongest | 31.363μs | 31.773μs | 31.888μs | 31.938μs | 0.220μs | ±0.69% |
| benchTotal   | 33.425μs | 33.707μs | 33.672μs | 34.043μs | 0.205μs | ±0.61% |
+--------------+----------+----------+----------+----------+---------+--------+

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

### Comparing with Fully Unfolded Tree

One assumption I wanted to benchmark was if the routing process will be quicker if we start with a fully unfolded tree instead of progressively exploring it at runtime.

To test this I've added two more `Route` classes that use the output from `Route::toArray()` as their route definitions. Both classes are slightly different in how they move down the routes tree with one using references and the other creating new objects.
```
php vendor/bin/phpbench run lab/Benchmark_Bitbucket_Ertuo_UnfoldedTree_Copy.php --report=short
php vendor/bin/phpbench run lab/Benchmark_Bitbucket_Ertuo_UnfoldedTree_Ref.php --report=short
```
