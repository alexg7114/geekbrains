<?php

namespace MyApp\Controllers;

use MyApp\Auth;
use MyApp\Models\Catalog;
use MyApp\Models\History;
use MyApp\Models\Users;
use MyApp\Models\Orders;

class UsersController extends Controller
{
    public function actionIndex()
    {
        $user = Auth::getUser();

        if (!$user) {
            $this->redirect('/users/login');
        }

        $this->render('users/index.twig', [
            'history' => History::getLast($user['id']),
        ]);
    }

    public function actionOrder()
    {
        $user = Auth::getUser();

        if (!$user) {
            $this->redirect('/login');
        }

        $basket = Auth::getBasket();
        Orders::createOrder($user['id'], $basket);
        Auth::clearBasket();

        $this->render('users/success.twig');
    }

    public function actionBasket()
    {
        $basket = Auth::getBasket();
        $ids = array_keys($basket['goods']);
        $goods = Catalog::getGoodsByIds($ids);

        $sum = 0;
        foreach ($goods as $k => $v) {
            $goods[$k]['count'] = $basket['goods'][$v['id']];
            $sum += $goods[$k]['sum'] = $v['price'] * $goods[$k]['count'];
        }

        $this->render('users/basket.twig', [
            'goods' => $goods,
            'sum' => $sum,
        ]);
    }

    public function actionLogin()
    {
        $error = null;

        if (isset($_POST['login'], $_POST['pass'])) {
            if (Users::check($_POST['login'], $_POST['pass'])) {
                Auth::login($_POST['login']);
                $this->redirect('/users');
            } else {
                $error = true;
            }
        }

        $this->render('users/login.twig', [
            'error' => $error,
        ]);
    }

    public function actionLogout()
    {
        Auth::logout();
        $this->redirect('/users/login');
    }
}
