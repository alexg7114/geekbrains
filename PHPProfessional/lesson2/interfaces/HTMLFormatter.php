<?php

class HTMLFormatter extends Formatter
{
    public function getHeaders(): array
    {
        return ['Content-type: text/html'];
    }

    public function render(array $data): void
    {
        echo '<div style="font-size: 150%">';
        echo '<pre>';
        var_dump($data);
        echo '</pre>';
        echo '</div>';
    }
}
