<?php

namespace MyApp\Models;

class History extends BaseModel
{
    public const TABLE = 'history';

    public static function get($userId, $limit = 5)
    {
        return;
        $stmt = self::db()
            ->getLink()
            ->query(
                'SELECT * FROM ' . self::TABLE
                . ' WHERE user_id=' . (int)$userId
                . ' ORDER BY id DESC LIMIT ' . (int)$limit);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function store($userId, $url)
    {
        return;
        $stmt = self::db()->getLink()->prepare('INSERT INTO ' . self::TABLE . ' SET user_id=:id, url=:url');
        $stmt->bindParam('id', $userId);
        $stmt->bindParam('url', $url);
        return $stmt->execute();
    }
}
