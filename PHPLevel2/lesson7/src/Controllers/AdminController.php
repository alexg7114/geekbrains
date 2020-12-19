<?php

namespace MyApp\Controllers;

use MyApp\Auth;
use MyApp\Models\Orders;
use MyApp\Models\Users;

class AdminController extends Controller
{
    public function beforeAction()
    {
        if (!Auth::hasRole(Users::ROLE_ADMIN) && !Auth::hasRole(Users::ROLE_CONTENT)) {
            $this->redirect('/login');
        }

        return parent::beforeAction();
    }

    public function actionIndex()
    {
        $this->render('admin/index.twig', [
            'orders' => Orders::getAll(),
            'statuses' => Orders::$statuses,
            'isAdmin' => Auth::hasRole(Users::ROLE_ADMIN),
        ]);
    }

    public function actionStatus()
    {
        if (!Auth::hasRole(Users::ROLE_ADMIN)) {
            $this->redirect('/login');
        }

        $id = $_GET['id'] ?? null;
        $status = $_GET['status'] ?? null;
        if (!$id || !$status) {
            return;
        }

        Orders::setStatus($id, $status);
    }
}
