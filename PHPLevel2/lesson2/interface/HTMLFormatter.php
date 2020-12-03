<?php

class HTMLFormatter extends Formatter
{
    protected function getHeader()
    {
        return 'Content-type: text/html';
    }

    public function render(array $data): void
    {
        echo '<pre>';
        var_dump($data);
        echo '</pre>';
    }
}
