<?php

namespace MyApp\Controllers;

class AccountController extends Controller
{
    /**
     * /account
     */
    public function actionIndex()
    {
        echo 'Users main data';
    }

    /**
     * /account/settings
     */
    public function actionSettings()
    {
        echo 'Users settings';
    }

    /**
     * /account/password
     */
    public function actionPassword()
    {
        echo 'Users change pwd page';
    }
}