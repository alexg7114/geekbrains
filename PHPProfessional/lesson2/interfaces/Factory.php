<?php

class Factory
{
    const TYPE_HTML = 'html';
    const TYPE_JSON = 'json';
    const TYPE_TEXT = 'text';

    public static function getFormatter($type): FormatterInterface
    {
        switch ($type) {
            case self::TYPE_HTML:
                return new HTMLFormatter();
            case self::TYPE_JSON:
                return new JSONFormatter();
            case self::TYPE_TEXT:
                return new TextFormatter();
        }
    }
}
