<?php

namespace MyApp\Controllers;

use MyApp\App;
use MyApp\Router;

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
//        $r = new Router(App::instance()->getConfig()['routing']);
//        $checks = [
//            '/asd//asd//',
//            '/',
//            'sdf/sdfsdf',
//            'sfsfdsdf',
//            'logout',
//            'catalog/123',
//            'catalog/123/234',
//            'pages/sdfsdf',
//            'pages/123/dfg',
//            'foo/bar',
//        ];
//        $res = [];
//        foreach ($checks as $item) {
//            $res[$item] = $r->route($item);
//        }
//        print_r($res);
//        exit;

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
