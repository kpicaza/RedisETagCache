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
     */
    public function create($content)
    {
        if (empty($content)) {
            return;
        }

        return md5($content);
    }
}
