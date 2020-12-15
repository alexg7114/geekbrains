<?php

namespace MyApp\Controllers;

use MyApp\Auth;
use MyApp\Models\Catalog;
use MyApp\Models\History;
use MyApp\Models\Order;
use MyApp\Models\Users;

class AuthController extends Controller
{
    public function actionIndex()
    {
        $error = null;

        if (isset($_POST['login'], $_POST['password'])) {
            if (!Auth::login($_POST['login'], $_POST['password'])) {
                $error = 'Неправильный логин или пароль!';
            }
        }

        if (Auth::getUser()) {
            $this->redirect('/auth/profile');
        }

        $this->render('auth/auth.twig', [
            'error' => $error,
        ]);
    }

    public function actionProfile()
    {
        if (null === $user = Auth::getUser()) {
            $this->redirect('/auth');
        }

        $this->render('auth/user.twig', [
            'user' => $user,
            'history' => History::get($user['id']),
        ]);
    }

    public function actionLogout()
    {
        Auth::logout();
        $this->redirect('/auth');
    }

    public function actionBasket()
    {
        $basket = Auth::getBasket();
        $ids = array_keys($basket['goods']);
        $goods = Catalog::getGoodsByIds($ids);
        $sum = 0;
        foreach ($goods as $k => $v) {
            $count = $basket['goods'][$v['id']];
            $goods[$k]['count'] = $count;
            $sum += $goods[$k]['sum'] = $count * $v['price'];
        }
        //print_r($goods);

        $this->render('auth/basket.twig', [
            'sum' => $sum,
            'goods' => $goods,
        ]);
    }

    public function actionOrder()
    {
        $user = Auth::getUser();

        if (!$user) {
            $this->redirect('/login');
        }

        //print_r($user);
        Order::make($user['id'], Auth::getBasket()['goods']);
        Auth::cleanBasket();

        $this->render('auth/ok.twig');
    }
}
