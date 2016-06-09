<?php
namespace Kpicaza\RedisETagCache;
use Kpicaza\ETagCache\ETagGeneratorInterface;
use Kpicaza\RedisETagCache\Exception\EmptyETagException;
/**
 * Class RedisETagGenerator
 * @package Kpicaza\RedisETagCache
 */
class RedisETagGenerator implements ETagGeneratorInterface
{
    /**
     * @param $content
     * @return string
     * @throws EmptyETagException
     */
    public function create($content)
    {
        if (empty($content)) {
            throw new EmptyETagException('You must add some content.');
        }

        return md5($content);
    }
}
