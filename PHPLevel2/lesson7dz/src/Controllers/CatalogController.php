<?php

namespace MyApp\Controllers;

use MyApp\Auth;
use MyApp\Models\Catalog;
use MyApp\Models\Goods;
use MyApp\Router;

class CatalogController extends Controller
{
    public function beforeAction()
    {
        if (isset($_GET['addGood'])) {
            Auth::addToBasket($_GET['addGood']);
            $this->redirect(Router::getURI());
        }

        return true;
    }

    /**
     * @link /catalog
     */
    public function actionIndex()
    {
        $this->render('catalog/index.twig', [
            'categories' => Catalog::getCategories(),
        ]);
    }

    public function actionCategory($params)
    {
        $catId = array_shift($params);
        $category = Catalog::getCategoryById($catId);

        $this->render('catalog/category.twig', [
            'category' => $category,
            'goods' => Catalog::getGoodsByCategory($catId),
        ]);
    }

    public function actionGood($params)
    {
        [$catId, $id] = $params;

        $category = Catalog::getCategoryById($catId);

        $this->render('catalog/good.twig', [
            'category' => $category,
            'good' => Catalog::getGoodById($id),
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
