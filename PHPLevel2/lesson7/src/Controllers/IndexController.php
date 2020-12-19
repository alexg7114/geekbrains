<?php

namespace MyApp\Controllers;

/**
 * Контроллер по умолчанию
 */
class IndexController extends Controller
{
    /**
     * Action по умолчанию
     */
    public function actionIndex()
    {
        $this->render('index.twig');
    }

    /**
     * Action, который вызывается если контроллер или action не найден
     */
    public function actionError()
    {
        $this->render('error.twig');
    }
}
