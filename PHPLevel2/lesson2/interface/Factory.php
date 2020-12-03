<?php

class Factory
{
    public static function getFormatter($type): FormatterInterface
    {
        switch ($type) {
            case Formatter::TYPE_JSON:
                return new JSONFormatter();
            case Formatter::TYPE_HTML:
                return new HTMLFormatter();
            default:
                return new TextFormatter();
        }
    }
}
