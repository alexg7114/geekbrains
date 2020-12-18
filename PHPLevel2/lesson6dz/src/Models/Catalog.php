<?php

namespace MyApp\Models;

class Catalog extends BaseModel
{
    public const TABLE_CATEGORIES = 'categories';
    public const TABLE_GOODS = 'goods';

    public static function getGoodsByIds(array $ids)
    {
        if (!count($ids)) {
            return [];
        }

        return self::db()
            ->getLink()
            ->query('SELECT * FROM ' . self::TABLE_GOODS . ' WHERE id IN (' . implode(',', $ids) . ')')
            ->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function getGoodsByCategory($id)
    {
        return self::db()
            ->getLink()
            ->query('SELECT * FROM ' . self::TABLE_GOODS . ' WHERE category_id=' . (int)$id)
            ->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function getGoodById($id)
    {
        return self::db()->getById(self::TABLE_GOODS, $id);
    }

    public static function getCategoryById($id)
    {
        return self::db()->getById(self::TABLE_CATEGORIES, $id);
    }

    public static function getCategories()
    {
        return self::db()->getTableData(self::TABLE_CATEGORIES);
    }
}
