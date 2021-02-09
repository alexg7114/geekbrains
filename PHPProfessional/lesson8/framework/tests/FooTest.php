<?php

class FooTest extends \PHPUnit\Framework\TestCase
{
    private $foo;

    public function setUp(): void
    {
        $this->foo = new \MyApp\Foo();
    }

    public function tearDown(): void
    {
        unset($this->foo);
    }

    public function testSum()
    {
        self::assertSame(7, $this->foo->sum(2, 5));
    }

    public function testReturnTrue()
    {
        self::assertTrue($this->foo->returnTrue());
    }

    public function testReturnNull()
    {
        self::assertNull($this->foo->returnNull());
    }

    /**
     * @dataProvider getStatusProvider
     * @param $type
     * @param $expected
     */
    public function testGetStatus($type, $expected)
    {
        $foo = new \MyApp\Foo($type);
        self::assertEquals($expected, $foo->getStatus());
    }

    public function getStatusProvider()
    {
        return [
            [1, 'First'],
            [2, 'Second'],
            [3, 'Third'],
            [4, 'Another'],
            [null, 'Another'],
            [123, 'Another'],
            ['', 'Another'],
        ];
    }
}
