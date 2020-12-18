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

    public static function setStatus($oderId, $status)
    {
        self::db()->getLink()->exec(
            'UPDATE ' . self::TABLE_ORDERS
            . ' SET status=' . (int)$status
            . ' WHERE id=' . (int)$oderId
        );
    }

    public static function getAll()
    {
        $rows = self::db()->getLink()->query(
            'SELECT orders.id, users.login, orders.`date`, orders.`status`,
            orders_goods.good_id, goods.category_id, orders_goods.price, orders_goods.`count`,goods.title
            FROM orders
            JOIN orders_goods ON orders.id=orders_goods.order_id
            JOIN goods ON orders_goods.good_id=goods.id
            JOIN users ON orders.user_id=users.id
            ORDER BY orders.`date` DESC'
        )->fetchAll(\PDO::FETCH_ASSOC);

        $orders = [];
        foreach ($rows as $row) {
            $id = $row['id'];
            $orders[$id]['login'] = $row['login'];
            $orders[$id]['date'] = $row['date'];
            $orders[$id]['status'] = $row['status'];
            $goodSum = $row['count'] * $row['price'];
            $orders[$id]['goods'][] = [
                'id' => $row['good_id'],
                'category_id' => $row['category_id'],
                'price' => $row['price'],
                'count' => $row['count'],
                'title' => $row['title'],
                'sum' => $goodSum,
            ];
            $orders[$id]['sum'] += $goodSum;
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
