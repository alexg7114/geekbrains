<?php

class Abc
{
    public $str = 'text';
}

class TypeHinting
{
    public static function createTH(): self
    {
        return new self();
    }

    public function abcStrPrint(Abc $abc): void
    {
        echo $abc->str;
    }

    public function printArray(array $arr): void
    {
        print_r($arr);
    }

    public function getRandomInt(int $min, int $max): int
    {
        return random_int($min, $max);
    }

    public function getFloat(float $number, int $precision): float
    {
        return round($number, $precision);
    }

    public function formatString(string $str): string
    {
        return strtoupper($str);
    }
}

$typeHinting = TypeHinting::createTH();

$typeHinting->printArray([1, 2, 3]);
echo $typeHinting->getRandomInt(5, 15), "\n";
echo $typeHinting->getFloat(1.234556, 3), "\n";
echo $typeHinting->formatString('Hello world!'), "\n";
$typeHinting->abcStrPrint(new Abc());
