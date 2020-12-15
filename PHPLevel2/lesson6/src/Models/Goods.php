<?php

namespace MyApp\Models;

class Goods
{
    /**
     * Добавить товар
     * @param $title
     * @param $price
     */
    public static function add($title, $price)
    {
        $stmt = \MyApp\App::instance()->getDb()->getLink()
            ->prepare('INSERT INTO goods SET title=:title, price=:price');
        $stmt->bindParam(':title', $title, \PDO::PARAM_STR);
        $stmt->bindParam(':price', $price, \PDO::PARAM_INT);
        $stmt->execute();
    }

    /**
     * Получить список всех товаров
     * @return array|null
     */
    public static function getAll()
    {
        return \MyApp\App::instance()->getDb()->getTableData('goods');
    }
}
