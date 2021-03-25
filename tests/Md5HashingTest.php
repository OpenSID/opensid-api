<?php

use App\Supports\Md5Hashing;
use Illuminate\Contracts\Hashing\Hasher;

class Md5HashingTest extends TestCase
{
    /** @var Hasher */
    protected $hash;

    protected function setUp(): void
    {
        parent::setUp();

        $this->hash = new Md5Hashing();
    }

    public function testInfo()
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage(sprintf(
            'This password md5 does not implement info. [%s].',
            Md5Hashing::class
        ));

        $this->hash->info('random-hash');
    }

    public function testMake()
    {
        $result = $this->hash->make(123456);

        $this->assertIsString($result);
    }

    public function testCheck()
    {
        $value = $this->hash->make(123456);
        $this->assertNotSame(123456, $value);
        $this->assertTrue($this->hash->check(123456, $value));
    }

    public function testNeedRehash()
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage(sprintf(
            'This password md5 does not implement needsRehash. [%s].',
            Md5Hashing::class
        ));

        $this->hash->needsRehash('random-hash');
    }
}
