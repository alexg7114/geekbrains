<?php

namespace MyApp\Models;

class Orders extends BaseModel
{
    public const STATUS_NEW = 1;
    public const STATUS_PROGRESS = 2;
    public const STATUS_REJECTED = 3;
    public const STATUS_DONE = 4;
    public static $statuses = [
        self::STATUS_NEW => 'Новый',
        self::STATUS_PROGRESS => 'В процессе',
        self::STATUS_REJECTED => 'Отменен',
        self::STATUS_DONE => 'Выполнен',
    ];

    public const TABLE_ORDERS = 'orders';
    public const TABLE_ORDERS_GOODS = 'orders_goods';

    public static function setStatus($id, $status)
    {
        self::db()->getLink()->exec(
            'UPDATE ' . self::TABLE_ORDERS
            . ' SET status=' . (int)$status
            . ' WHERE id=' . (int)$id
        );
    }

    public static function getAllRawData()
    {
        return self::db()->getLink()->query(
            'SELECT orders.id,orders.`date`,orders.status,
            orders_goods.price,orders_goods.`count`,orders_goods.good_id,
            users.login, goods.title,goods.category_id
            FROM orders
            JOIN orders_goods ON orders.id=orders_goods.order_id
            JOIN users ON orders.user_id=users.id
            JOIN goods ON orders_goods.good_id=goods.id
            ORDER BY orders.`date` DESC'
        )->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function getAll()
    {
        $rows = static::getAllRawData();

        $orders = [];
        foreach ($rows as $row) {
            $id = $row['id'];
            if (!isset($orders[$id])) {
                $orders[$id] = [
                    'date' => $row['date'],
                    'status' => $row['status'],
                    'login' => $row['login'],
                    'sum' => 0,
                    'goods' => [],
                ];
            }

            $sum = $row['price'] * $row['count'];
            $orders[$id]['goods'][] = [
                'price' => $row['price'],
                'count' => $row['count'],
                'id' => $row['good_id'],
                'title' => $row['title'],
                'category_id' => $row['category_id'],
                'sum' => $sum,
            ];

            $orders[$id]['sum'] += $sum;
        }

        return $orders;
    }

    public static function createOrder($userId, $basket)
    {
        $goodsIds = $basket['goods'];
        if (empty($goodsIds)) {
            return;
        }

        self::db()->getLink()->exec(
            'INSERT INTO ' . self::TABLE_ORDERS
            . ' SET user_id=' . (int)$userId . ', status=' . self::STATUS_NEW
        );
        $orderId = self::db()->getLink()->lastInsertId();

        $goods = Catalog::getGoodsByIds(array_keys($goodsIds));
        foreach ($goods as $good) {
            self::db()->getLink()->exec(
                'INSERT INTO ' . self::TABLE_ORDERS_GOODS
                . ' SET order_id = ' . $orderId
                . ', good_id = ' . $good['id']
                . ', price = ' . $good['price']
                . ', `count` = ' . $goodsIds[$good['id']]
            );
        }
    }
}
