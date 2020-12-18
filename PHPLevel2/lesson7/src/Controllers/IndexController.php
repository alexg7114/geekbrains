<?php

namespace MyApp\Controllers;

use MyApp\App;
use MyApp\Models\Users;
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
        //Тест роутера
        /*$tests = [
            '/asd//asd//',
            '',
            'sdfds/sdfsdf',
            'logout',
            'catalog/123',
            'catalog/123/234',
            'pages/this_is_good_page',
            'pages/this_is_good_page/and_subpage',
            'foo/bar',
        ];
        $res = [];
        $router = new Router(App::instance()->getConfig()['routing']);
        foreach ($tests as $test) {
            $res[$test] = $router->check($test);
        }

        print_r($res);
        exit;*/

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
