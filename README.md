# RedisETagCache

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