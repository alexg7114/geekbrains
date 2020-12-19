<?php

namespace MyApp;

use MyApp\Models\Users;

class Auth
{
    public static function getBasket()
    {
        self::initBasket();

        return $_SESSION['basket'];
    }

    public static function addToBasket($id)
    {
        self::initBasket();

        $_SESSION['basket']['count']++;
        $_SESSION['basket']['goods'][$id]++;
    }

    public static function clearBasket()
    {
        self::initBasket(true);
    }

    private static function initBasket($force = false)
    {
        if ($force || empty($_SESSION['basket'])) {
            $_SESSION['basket'] = [
                'count' => 0,
                'goods' => [],
            ];
        }
    }

    public static function getUser()
    {
        return $_SESSION['user'];
    }

    public static function login($login)
    {
        $user = Users::get($login);
        $_SESSION['user'] = $user;
        $_SESSION['user']['roles'] = Users::getRoles($user['id']);
    }

    public static function hasRole(int $role): bool
    {
        if (empty($_SESSION['user']['roles'])) {
            return false;
        }

        return in_array($role, $_SESSION['user']['roles']);
    }

    public static function logout()
    {
        $_SESSION['user'] = null;
        self::clearBasket();
    }
}
