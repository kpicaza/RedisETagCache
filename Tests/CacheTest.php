<?php
namespace Kpicaza\Tests\RedisETagCache;

use Kpicaza\RedisETagCache\RedisETagCache;
use Kpicaza\RedisETagCache\RedisETagGenerator;
use M6Web\Component\RedisMock\RedisMockFactory;
use Faker;

class CacheTest extends \PHPUnit_Framework_TestCase
{
    const FIXED_ID = '/api/users';
    const STRING_VALUE = 'MyStringValue';

    private $redis;
    private $generator;
    private $cache;
    private $faker;

    public function setUp()
    {
        parent::setUp();

        $factory = new RedisMockFactory();
        $this->redis = $factory->getAdapter('Predis\Client', true);
        $this->generator = new RedisETagGenerator();
        $this->cache = new RedisETagCache($this->generator, $this->redis);
        $this->faker = Faker\Factory::create();
    }

    public function testETagCreateWithStringValueShouldReturnValidEtag()
    {
        $etag = $this->generator->create(self::STRING_VALUE);

        $this->assertEquals(md5(self::STRING_VALUE), $etag);
    }

    public function testETagCreateWithEmptyValueShouldThrownEmptyETagException()
    {
        $this->setExpectedException('\Kpicaza\RedisETagCache\Exception\EmptyETagException');
        $etag = $this->generator->create('');
    }

    public function testCacheSetETagWithStringValueReturnTrue()
    {
        $etagSaved = $this->cache->setEtag(self::FIXED_ID, self::STRING_VALUE);

        $this->assertEquals(true, $etagSaved);
    }

    public function testCacheGetETagByFixedIdReturnValidEtag()
    {
        $etag = $this->cache->getETag(self::FIXED_ID);

        $this->assertEquals($etag, md5(self::STRING_VALUE));
    }

    public function testCacheGetETagByNullIdShouldBeNull()
    {
        $etag = $this->cache->getETag(null);

        $this->assertEquals($etag, null);
    }
}
