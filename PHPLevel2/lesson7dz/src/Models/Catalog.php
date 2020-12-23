<?php

namespace MyApp\Models;

use MyApp\GoodsImages;

class Catalog extends BaseModel
{
    use GoodsImages;

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
        $goods = self::db()
            ->getLink()
            ->query('SELECT * FROM ' . self::TABLE_GOODS . ' WHERE category_id=' . (int)$id)
            ->fetchAll(\PDO::FETCH_ASSOC);

        foreach ($goods as $k => $good) {
            $images = self::getImagesUrls($good['id']);
            $goods[$k]['image'] = array_shift($images);
        }

        return $goods;
    }

    public static function getGoodById($id)
    {
        $good = self::db()->getById(self::TABLE_GOODS, $id);
        if (!$good) {
            return null;
        }

        $good['images'] = self::getImagesUrls($good['id']);

        return $good;
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
