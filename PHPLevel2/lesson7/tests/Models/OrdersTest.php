<?php

namespace Models;

use MyApp\Models\Orders;

final class OrdersTest extends \BaseTest
{
    public function testGetAll()
    {
        $orders = $this->getOrdersMock();

        $orders::$rawData = [
            [
                'id' => 1,
                'login' => 'admin',
                'date' => '123123',
                'status' => '1',
                'price' => 1000,
                'good_id' => 2,
                'category_id' => 3,
                'count' => 2,
                'title' => 'Title',
            ],
            [
                'id' => 1,
                'login' => 'admin',
                'date' => '123123',
                'status' => '1',
                'price' => 500,
                'good_id' => 3,
                'category_id' => 1,
                'count' => 1,
                'title' => 'Title2',
            ],
        ];

        $all = $orders::getAll();

        $this->assertEquals(2500, $all[1]['sum']);
        $this->assertCount(2, $all[1]['goods']);
    }

    protected function getOrdersMock()
    {
        return new class extends Orders {
            public static $rawData;

            protected static function getOrdersRawData()
            {
                return self::$rawData;
            }
        };
    }
}
