<?php

namespace MyApp\Controllers;

use MyApp\Models\Catalog;
use MyApp\Models\Goods;

class CatalogController extends Controller
{
    /**
     * @link /catalog
     */
    public function actionIndex()
    {
//        $this->render('goods.twig', [
//            'goods' => Goods::getAll(),
//        ]);

        $this->render('catalog/categories.twig', [
            'categories' => Catalog::getCategories(),
        ]);


    }

    public function actionCategory($params)
    {
        $id = array_shift($params);
        $this->render('catalog/category.twig', [
            'id' => $id,
            'title' => Catalog::getCategoryTitle($id),
            'goods' => Catalog::getGoods($id),
        ]);
    }

    public function actionGood($params)
    {
        [$catId, $id] = $params;

        $this->render('catalog/good.twig', [
            'cat' => [
                'id' => $catId,
                'title' => Catalog::getCategoryTitle($catId),
            ],
            'good' => Catalog::getGood($id),
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
