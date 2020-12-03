<?php

interface FormatterInterface
{
    public function sendHeaders();
    public function render(array $data): void;
}
