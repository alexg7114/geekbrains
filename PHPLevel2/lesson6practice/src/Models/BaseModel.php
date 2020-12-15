<?php

namespace MyApp\Models;

abstract class BaseModel
{
    protected static function db()
    {
        return \MyApp\App::instance()->getDb();
    }
}
