<?php

namespace Models;

use MyApp\Models\Catalog;

class CatalogTest extends \BaseTest
{
    public function testGetCategoryById()
    {
        $categories = Catalog::getCategories();
        $expected = array_shift($categories);

        $actual = Catalog::getCategoryById($expected['id']);

        self::assertEquals($expected, $actual);
    }

    public function testGetCategories()
    {
        $categories = Catalog::getCategories();
        self::assertNotEmpty($categories);
    }
}
