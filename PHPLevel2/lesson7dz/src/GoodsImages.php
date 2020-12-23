<?php

namespace MyApp;

trait GoodsImages
{
    public static function getFilesList($id): array
    {
        $dir = App::instance()->getConfig()['goodsImages']['dir'] . '/' . $id;
        if (!file_exists($dir)) {
            return [];
        }

        $files = scandir($dir);
        return array_slice($files, 2);
    }

    public static function getImagesUrls($id)
    {
        $files = self::getFilesList($id);
        $url = App::instance()->getConfig()['goodsImages']['url'];

        $urls = [];
        foreach ($files as $file) {
            $urls[] = $url . '/' . $id . '/' . $file;
        }

        return $urls;
    }
}
