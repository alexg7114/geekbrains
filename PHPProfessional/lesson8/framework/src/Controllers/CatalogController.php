<?php

namespace MyApp\Controllers;

use MyApp\App;
use MyApp\Basket;
use MyApp\GoodsImages;
use MyApp\Models\Catalog;
use MyApp\Models\Goods;

class CatalogController extends Controller
{
    /**
     * /catalog
     */
    public function actionIndex()
    {
        $this->render('catalog/index.twig', [
            'categories' => Catalog::getCategories(),
        ]);
    }

    /**
     * /catalog/N
     */
    public function actionCategory($params)
    {
        $catId = array_shift($params);

        if (!($category = Catalog::getCategoryById($catId))) {
            $this->redirect('/catalog');
        }

        $this->render('catalog/category.twig', [
            'category' => $category,
            'goods' => Goods::getByCategory($catId),
        ]);
    }

    /**
     * /catalog/N/N
     */
    public function actionGood($params)
    {
        if (isset($_GET['add'])) {
            Basket::add($_GET['add']);
        }

        [$catId, $goodId] = $params;

        if (!($category = Catalog::getCategoryById($catId))) {
            $this->redirect('/catalog');
        }

        if (!($good = Goods::getById($goodId))) {
            $this->redirect('/catalog');
        }

        $gi = new GoodsImages(App::getInstance()->getConfig()['goodsImages']);

        $this->render('catalog/good.twig', [
            'category' => $category,
            'good' => $good,
            'images' => $gi->getImagesUrls($goodId),
        ]);
    }
}
