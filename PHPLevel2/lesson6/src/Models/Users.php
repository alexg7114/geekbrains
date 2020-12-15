<?php

namespace MyApp\Models;

class Users extends BaseModel
{
    public const TABLE = 'users';

    public static function getUser($login)
    {
        $stmt = self::db()->getLink()->prepare('SELECT * FROM ' . self::TABLE . ' WHERE login=:login LIMIT 1');
        $stmt->bindParam('login', $login, \PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch(\PDO::FETCH_ASSOC);
        if (empty($user)) {
            return false;
        }

        return $user;
    }

    public static function check($login, $password)
    {
        if (empty($user = self::getUser($login))) {
            return false;
        }

        return password_verify($password, $user['pass']);
    }

    public static function add($login, $password): bool
    {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = self::db()->getLink()->prepare("INSERT INTO " . self::TABLE . " SET login=:login, pass=:pass");
        $stmt->bindParam('login', $login, \PDO::PARAM_STR);
        $stmt->bindParam('pass', $password, \PDO::PARAM_STR);
        return $stmt->execute();
    }
}
