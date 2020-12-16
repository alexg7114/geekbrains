<?php

namespace MyApp\Models;

class Users extends BaseModel
{
    const TABLE = 'users';

    public static function check($login, $password)
    {
        $user = self::get($login);
        if (!$user) {
            return false;
        }

        return password_verify($password, $user['pass']);
    }

    public static function get($login)
    {
        $stmt = self::db()->getLink()->prepare('SELECT * FROM ' . self::TABLE . ' WHERE login=:login LIMIT 1');
        $stmt->bindParam('login', $login, \PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public static function add($login, $password)
    {
        $hash = password_hash($password, PASSWORD_DEFAULT);

        $stmt = self::db()->getLink()->prepare('INSERT INTO ' . self::TABLE . ' SET login=:login, pass=:pass');
        $stmt->bindParam('login', $login, \PDO::PARAM_STR);
        $stmt->bindParam('pass', $hash, \PDO::PARAM_STR);
        $stmt->execute();
    }
}
