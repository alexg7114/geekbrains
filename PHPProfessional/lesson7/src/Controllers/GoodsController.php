<?php

namespace MyApp\Controllers;

use MyApp\Models\Goods;

/**
 * Old controller. See CatalogController instead.
 */
class GoodsController extends Controller
{
    /**
     * /goods
     */
    public function actionIndex()
    {
        $goods = Goods::getAll();

        $this->render('goods.twig', [
            'goods' => $goods,
        ]);
    }

    /**
     * /goods/add
     */
    public function actionAdd()
    {
        if (isset($_POST['title'])) {
            Goods::add($_POST['title'], $_POST['price']);
            $this->redirect();
        }

        $this->render('add.twig');
    }
}