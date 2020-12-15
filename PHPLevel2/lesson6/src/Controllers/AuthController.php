<?php

namespace MyApp\Controllers;

use MyApp\Auth;
use MyApp\Models\History;

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
}
