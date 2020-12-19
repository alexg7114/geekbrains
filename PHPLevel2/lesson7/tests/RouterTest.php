<?php

final class RouterTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider parseProvider
     * @param $url
     * @param $expected
     */
    public function testParse($url, $expected)
    {
        $router = new \MyApp\Router([
            'login' => 'users/login',
            'logout' => 'users/logout',
            'basket' => 'users/basket',
            'order' => 'users/order',
            'catalog\/([0-9]+)\/([0-9]+)' => 'catalog/good',
            'catalog\/([0-9]+)' => 'catalog/category',
            'catalog' => 'catalog/index',
            'pages\/(.*)' => 'pages/index',
            '(\w+)\/(\w+)' => '<controller>/<action>',
            '(\w+)' => '<controller>/index',
            '^$' => 'index/index',
            '(.*)' => 'index/error',
        ]);
        $actual = $router->parse($url);
        $this->assertEquals($expected, $actual);
    }

    public function parseProvider()
    {
        return [
            ['/asd//qwe//', ['asd', 'qwe', []]],
            ['', ['index', 'index', []]],
            ['logout', ['users', 'logout', []]],
            ['catalog/123', ['catalog', 'category', ['123']]],
            ['catalog/123/234', ['catalog', 'good', ['123', '234']]],
            ['pages/this_is_good_page/and_subpage', ['pages', 'index', ['this_is_good_page/and_subpage']]],
        ];
    }

    /**
     * @dataProvider getURIProvider
     * @param $path
     * @param $expected
     */
    public function testGetURI($path, $expected)
    {
        $_GET['path'] = $path;
        $actual = \MyApp\Router::getURI();
        $this->assertEquals($expected, $actual);
    }

    public function getURIProvider()
    {
        return [
            ['/foo/bar?asd=qwe', '/foo/bar'],
            ['/foo/bar', '/foo/bar'],
            ['?asd=qwe', ''],
        ];
    }

    /**
     * @dataProvider filterProvider
     * @param $url
     * @param $expected
     */
    public function testFilter($url, $expected)
    {
        $actual = \MyApp\Router::filter($url);
        $this->assertEquals($expected, $actual);
    }

    public function filterProvider()
    {
        return [
            ['/sdfg///dfgdf/', 'sdfg/dfgdf'],
            ['/', ''],
            ['//dfgdf/', 'dfgdf'],
            ['', ''],
        ];
    }
}
