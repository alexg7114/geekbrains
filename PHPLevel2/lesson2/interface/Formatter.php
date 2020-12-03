<?php

abstract class Formatter implements FormatterInterface
{
    public const TYPE_HTML = 'html';
    public const TYPE_JSON = 'json';
    public const TYPE_TEXT = 'text';

    abstract protected function getHeader();

    public function sendHeaders()
    {
        header($this->getHeader());
    }

    abstract public function render(array $data): void;
}
