<?php

class JSONFormatter extends Formatter
{
    public function getHeaders(): array
    {
        return ['Content-type: application/json'];
    }

    public function render(array $data): void
    {
        echo json_encode($data);
    }
}
