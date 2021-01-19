<?php
declare(strict_types=1);

/* Type hinting для классов */

//C -> B -> A
class A
{
}

class B extends A
{
}

class C extends B
{
}

class CheckMe
{
    public function inA(A $a): A
    {
        echo 'A ok', PHP_EOL;
        return $a;
    }

    public function inB(B $b): A
    {
        echo 'B ok', PHP_EOL;
        return $b;
    }

    public function inC(C $c): A
    {
        echo 'C ok', PHP_EOL;
        return $c;
    }
}

$a = new A();
$b = new B();
$c = new C();

$ch = new CheckMe();
$ch->inA($a);
$ch->inB($b);
$ch->inC($c);

/* Проверка инстанса класса */
echo ($a instanceof A) ? '+' : '-', PHP_EOL;
echo ($a instanceof B) ? '+' : '-', PHP_EOL;
echo ($a instanceof C) ? '+' : '-', PHP_EOL;
echo ($b instanceof A) ? '+' : '-', PHP_EOL;
echo ($b instanceof B) ? '+' : '-', PHP_EOL;
echo ($b instanceof C) ? '+' : '-', PHP_EOL;
echo ($c instanceof A) ? '+' : '-', PHP_EOL;
echo ($c instanceof B) ? '+' : '-', PHP_EOL;
echo ($c instanceof C) ? '+' : '-', PHP_EOL;

/* Type hinting для скаляров */

class TypeHinting
{
    public function printArray(array $arr): void
    {
        print_r($arr);
    }

    public function isArray(array $arr): bool
    {
        return is_array($arr);
    }

    public function printFloat(float $number, int $precision): void
    {
        echo round($number, $precision), PHP_EOL;
    }

    public function toUpper(string $str): string
    {
        return strtoupper($str);
    }
}

$th = new TypeHinting();

$th->printArray([1, 2, 3]);
echo $th->toUpper('Hello');
