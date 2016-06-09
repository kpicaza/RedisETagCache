<?php
namespace Kpicaza\RedisETagCache;
use Kpicaza\ETagCache\ETagCacheInterface;
use Predis\Client;
use Kpicaza\ETagCache\ETagGeneratorInterface;
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
     * @param Client $client
     */
    public function __construct(ETagGeneratorInterface $generator, Client $client)
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
