<?php

abstract class Formatter implements FormatterInterface
{
    abstract public function getHeaders(): array;

    public function sendHeaders(): void
    {
        $headers = $this->getHeaders();
        foreach ($headers as $header) {
            header($header);
        }
    }
}
