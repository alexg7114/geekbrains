<?php
namespace Models;

use MyApp\Models\Catalog;

final class CatalogTest extends \BaseTest
{
    public function testGetGoodsByCategory()
    {
        $emptyGoods = Catalog::getGoodsByCategory('sdfsdf');
        $this->assertIsArray($emptyGoods);
        $this->assertEmpty($emptyGoods);
    }

    public function testGetGoodsByIds()
    {
        $this->assertEmpty(Catalog::getGoodsByIds([]));
    }

    public function testGetCategoryById()
    {
        $categories = Catalog::getCategories();

        foreach ($categories as $category) {
            $cat = Catalog::getCategoryById($category['id']);

            $this->assertEquals($category, $cat);
        }
    }
}