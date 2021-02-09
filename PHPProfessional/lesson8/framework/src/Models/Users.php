<?php

namespace MyApp\Models;

class Users extends Model
{
    const ROLE_ADMIN = 1;
    const ROLE_CONTENT = 2;
    const ROLE_USER = 3;

    const TABLE = 'users';
    const TABLE_ROLES = 'users_roles';

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
        $stmt = self::link()->prepare('SELECT * FROM ' . self::TABLE . ' WHERE login=:login LIMIT 1');
        $stmt->bindParam('login', $login, \PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch(\PDO::FETCH_ASSOC);

        if (!$user) {
            return false;
        }

        $user['roles'] = self::getRoles($user['id']);

        return $user;
    }

    public static function getRoles($userId)
    {
        $rows = self::link()
            ->query('SELECT role FROM ' . self::TABLE_ROLES . ' WHERE user_id=' . (int)$userId)
            ->fetchAll(\PDO::FETCH_ASSOC);

        $roles = [];
        foreach ($rows as $row) {
            $roles[] = (int)$row['role'];
        }

        return $roles;
    }
}
