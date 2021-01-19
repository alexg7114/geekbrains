<?php

interface FormatterInterface
{
    public function sendHeaders(): void;

    public function render(array $data): void;
}
