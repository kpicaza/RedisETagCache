<?php
namespace Kpicaza\RedisETagCache;
use Kpicaza\ETagCache\ETagCacheInterface;
use Kpicaza\ETagCache\ETagGeneratorInterface;
use Predis\ClientInterface;

/**
 * Class RedisETagCache
 * @package Kpicaza\RedisETagCache
 */
class RedisETagCache implements ETagCacheInterface
{
    protected $client;
    protected $generator;
    /**
     * RedisETagCache constructor.
     * @param ETagGeneratorInterface $generator
     * @param ClientInterface $client
     */
    public function __construct(ETagGeneratorInterface $generator, ClientInterface $client)
    {
        $this->client = $client;
        $this->generator = $generator;
    }
    /**
     * @param $id
     * @param $item
     * @return bool
     */
    public function setETag($id, $item)
    {
        return (bool) $this->client->set($id, $this->generator->create($item));
    }
    /**
     * @param $id
     * @return mixed
     */
    public function getETag($id)
    {
        return $this->client->get($id);
    }
}
