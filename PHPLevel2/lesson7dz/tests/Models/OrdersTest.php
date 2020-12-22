<?php
namespace Models;

use MyApp\Models\Orders;
use PHPUnit\Framework\TestCase;

class OrdersTest extends TestCase
{
    public function testGetAll()
    {
        $orders = $this->getOrdersMock();

        $orders::$rawData = [
            [
                'id' => 1,
                'date' => 'qweqwe',
                'status' => 1,
                'price' => 100,
                'count' => 2,
                'good_id' => 3,
                'login' => 'admin',
                'title' => 'foo',
                'category_id' => 7,
            ],
            [
                'id' => 1,
                'date' => 'qweqwe',
                'status' => 1,
                'price' => 200,
                'count' => 3,
                'good_id' => 4,
                'login' => 'admin',
                'title' => 'bar',
                'category_id' => 8,
            ],
        ];
        $actual = $orders::getAll();

        $this->assertEquals(800, $actual[1]['sum']);
        $this->assertCount(2, $actual[1]['goods']);
    }

    protected function getOrdersMock()
    {
        return new class extends Orders {
            public static $rawData;

            public static function getAllRawData()
            {
                return self::$rawData;
            }
        };
    }
}
