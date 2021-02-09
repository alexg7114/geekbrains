<?php

class GoodsImagesTest extends \PHPUnit\Framework\TestCase
{
    public function testGetImagesUrls()
    {
        $gi = new \MyApp\GoodsImages([
            'dir' => __DIR__ . '/data/goodsimages',
            'url' => '/goods',
        ]);

        $images = $gi->getImagesUrls(1);
        self::assertEquals([
            '/goods/1/img1.jpg',
            '/goods/1/img2.jpg',
        ], $images);

        $empty = $gi->getImagesUrls(5);
        self::assertIsArray($empty);
        self::assertEmpty($empty);
    }
}
