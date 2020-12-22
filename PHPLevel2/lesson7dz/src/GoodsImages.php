<?php

namespace MyApp;

trait GoodsImages
{
    public static function getImgList($id)
    {
        $dir = App::instance()->getConfig()['goodsImages']['dir'] . '/' . $id;
        if (!file_exists($dir)) {
            return [];
        }

        $files = scandir($dir);
        array_shift($files);
        array_shift($files);

        return $files;
    }

    public static function getPublicImages($id)
    {
        $files = self::getImgList($id);
        $publicPath = App::instance()->getConfig()['goodsImages']['public'] . '/' . $id;

        $public = [];
        foreach ($files as $file) {
            $public[] = $publicPath . '/' . $file;
        }

        return $public;
    }
}
