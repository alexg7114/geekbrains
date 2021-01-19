<?php

class TextFormatter extends Formatter
{
    public function getHeaders(): array
    {
        return ['Content-type: text/plain'];
    }

    public function render(array $data): void
    {
        print_r($data);
    }
}
