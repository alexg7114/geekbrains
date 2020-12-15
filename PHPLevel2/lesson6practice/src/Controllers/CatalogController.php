<?php

namespace MyApp\Controllers;

use MyApp\Models\Goods;

class CatalogController extends Controller
{
    /**
     * @link /catalog
     */
    public function actionIndex()
    {
        $this->render('goods.twig', [
            'goods' => Goods::getAll(),
        ]);
    }

    /**
     * @link /catalog/add
     */
    public function actionAdd()
    {
        Goods::add($_POST['title'], $_POST['price']);
        $this->redirect('\catalog');
    }
}
