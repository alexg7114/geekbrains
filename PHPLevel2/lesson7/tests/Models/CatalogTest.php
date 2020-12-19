<?php
namespace Models;

use MyApp\Models\Catalog;

class CatalogTest extends \BaseTest
{
    public function testGetGoodsByIds()
    {
        $actual = Catalog::getGoodsByIds([]);
        $this->assertIsArray($actual);
        $this->assertEmpty($actual);
    }

    public function testGetCategoryById()
    {
        $categories = Catalog::getCategories();
        $expected = array_shift($categories);

        $this->assertEquals($expected, Catalog::getCategoryById($expected['id']));
    }
}
