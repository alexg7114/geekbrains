<?php

namespace MyApp;

class GoodsImages
{
    private $config;

    public function __construct($config)
    {
        $this->config = $config;
    }

    public function getImagesUrls($id)
    {
        $dir = $this->config['dir'] . '/' . $id;

        $files = [];
        if (file_exists($dir)) {
            $files = array_slice(scandir($dir), 2);
        }

        $urls = [];
        foreach ($files as $file) {
            $urls[] = $this->config['url'] . '/' . $id . '/' . $file;
        }

        return $urls;
    }
}
