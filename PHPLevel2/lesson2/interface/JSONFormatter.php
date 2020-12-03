<?php

class JSONFormatter extends Formatter
{
    protected function getHeader()
    {
        return 'Content-type: application/json';
    }

    public function render(array $data): void
    {
        echo json_encode($data);
    }
}
