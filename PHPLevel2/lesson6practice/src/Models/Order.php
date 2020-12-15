<?php

namespace MyApp\Models;

class Order extends BaseModel
{
    public const STATUS_NEW = 1;
    public const STATUS_PROGRESS = 2;
    public const STATUS_REJECTED = 3;
    public const STATUS_DONE = 4;

    public static function make($userId, $goods)
    {
        if (!count($goods)) return false;

        self::db()->getLink()->exec('INSERT INTO orders SET user_id = ' . (int)$userId . ', status= ' . self::STATUS_NEW);
        $orderId = self::db()->getLink()->lastInsertId();

        foreach ($goods as $id => $count) {
            $good = Catalog::getGood($id);
            self::db()->getLink()->exec('INSERT INTO orders_goods SET order_id='.(int)$orderId.',good_id='.$good['id'].',price='.$good['price'].',`count`='.$count);
        }

        return $orderId;
    }
}
