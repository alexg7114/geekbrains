<?php

namespace MyApp;

use MyApp\Models\Users;

class Auth
{
    public static function login($login, $pass)
    {
        if (Users::check($login, $pass)) {
            self::rememberUser($login);
            return true;
        }

        return false;
    }

    private static function rememberUser($login)
    {
        $_SESSION['user'] = Users::getUser($login);
    }

    public static function getUser()
    {
        return !empty($_SESSION['user']) ? $_SESSION['user'] : null;
    }

    public static function logout()
    {
        unset($_SESSION['user']);
    }
}
