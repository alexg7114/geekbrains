<?php

class TextFormatter extends Formatter
{
    protected function getHeader()
    {
        return 'Content-type: text/plain';
    }

    public function render(array $data): void
    {
        print_r($data);
    }
}
