<?php

namespace MyApp\Models;

class History extends BaseModel
{
    public const TABLE = 'history';

    public static function add($userId, $url)
    {
        $stmt = self::db()->getLink()->prepare('INSERT INTO ' . self::TABLE . ' set user_id=:id, url=:url');
        $stmt->bindParam('id', $userId, \PDO::PARAM_INT);
        $stmt->bindParam('url', $url, \PDO::PARAM_STR);
        $stmt->execute();
    }

    public static function getLast($userId, $limit = 5)
    {
        return self::db()->getLink()->query(
            'SELECT * FROM ' . self::TABLE
            . ' WHERE user_id=' . (int)$userId
            . ' ORDER BY id DESC LIMIT ' . (int)$limit)
            ->fetchAll(\PDO::FETCH_ASSOC);
    }
}
