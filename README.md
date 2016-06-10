# RedisETagCache

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/kpicaza/RedisETagCache/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/kpicaza/RedisETagCache/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/kpicaza/RedisETagCache/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/kpicaza/RedisETagCache/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/kpicaza/RedisETagCache/badges/build.png?b=master)](https://scrutinizer-ci.com/g/kpicaza/RedisETagCache/build-status/master)

## Requirements:

This package depends on [Predis](https://packagist.org/packages/predis/predis). See installation instruction at [Github repo](https://github.com/nrk/predis).

## Installation:

    composer require kpicaza/redis-etag-cache

## Usage:

```
<?php

use Kpicaza\RedisETagCache\RedisETagGenerator;
use Kpicaza\RedisETagCache\RedisETagCache;
use Predis\Client;

$client = new Client();
$eTagGenerator = new RedisETagGenerator();
$eTag = new RedisETagCache($eTagGenerator);

// Set ETag.
$eTag = $eTag->setETag(sprintf('%s_%s', $method, $uri), $response->getContent());

// Get ETag.
$eTag = $this->cache->getETag(sprintf('%s_%s', $method, $uri))
```