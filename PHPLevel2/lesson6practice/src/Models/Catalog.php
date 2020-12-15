<?php

namespace MyApp\Models;

class Catalog extends BaseModel
{
    const TABLE_CATEGORIES = 'categories';
    const TABLE_GOODS = 'goods';

    public static function getGood($id)
    {
        return self::db()->getById(self::TABLE_GOODS, $id);
    }

    public static function getGoods($catId)
    {
        return self::db()
            ->getLink()
            ->query('SELECT * FROM ' . self::TABLE_GOODS . ' WHERE category_id = ' . (int)$catId)
            ->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function getCategoryTitle($id)
    {
        $data = self::db()->getById(self::TABLE_CATEGORIES, $id);
        if ($data) {
            return $data['title'];
        }

        return null;
    }

    public static function getCategories()
    {
        return self::db()->getTableData(self::TABLE_CATEGORIES);
    }

    public static function getGoodsByIds(array $ids)
    {
        if (empty($ids)) {
            return [];
        }
        $stmt = self::db()->getLink()->query('SELECT * FROM ' . self::TABLE_GOODS . ' WHERE id IN (' . implode(',', $ids) . ')');
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}
