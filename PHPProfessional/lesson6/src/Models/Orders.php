<?php

namespace MyApp\Models;

class Orders extends Model
{
    const STATUS_NEW = 1;
    const STATUS_PROGRESS = 2;
    const STATUS_REJECTED = 3;
    const STATUS_DONE = 4;

    const TABLE_ORDERS = 'orders';
    const TABLE_ORDERS_GOODS = 'orders_goods';

    public static function add($userId, $goodsCounts): int
    {
        // Create record in orders table
        self::link()->exec(
            'INSERT INTO ' . self::TABLE_ORDERS
            . ' SET user_id=' . (int)$userId
            . ', status=' . self::STATUS_NEW
        );
        $orderId = self::link()->lastInsertId();

        // Create records in orders_goods table
        foreach ($goodsCounts as $id => $count) {
            $good = Goods::getById($id);

            self::link()->exec(
                'INSERT INTO ' . self::TABLE_ORDERS_GOODS
                . ' SET order_id=' . $orderId
                . ', good_id=' . (int)$id
                . ', price=' . $good['price']
                . ', `count`=' . (int)$count
            );
        }

        return $orderId;
    }
}
