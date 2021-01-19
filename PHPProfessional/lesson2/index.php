<?php

//Присвоение по значению
$a = 5;
$b = $a;
$b += 3;
print_r([$a, $b]);

//Присвоение по ссылке
$a = 5;
$b = &$a;
$a += 3;
print_r([$a, $b]);

class Abc
{
    public $str = 'text';
}

//Объект всегда присвается по ссылке
$abc1 = new Abc();
$abc2 = $abc1;
$abc2->str = 'another text';
print_r([$abc1->str, $abc2->str]);

//Передача скалярного значения по ссылке
function modifyScalar(&$var)
{
    $var += 3;
}

function modifyObject($obj)
{
    $obj->str = 'some text';
}

$i = 5;
modifyScalar($i);
echo $i, PHP_EOL;

modifyObject($abc1);
echo $abc1->str, PHP_EOL;

/* Сравнение объектов */
$a1 = new Abc();
$a2 = $a1;
$a3 = new Abc();

echo $a1 === $a2 ? 'Yes' : 'No', PHP_EOL;
echo $a1 === $a3 ? 'Yes' : 'No', PHP_EOL;
echo PHP_EOL;

/* Сериализация */
$s1 = new Abc();
$serialized = serialize($s1);
echo $serialized, PHP_EOL;
$s2 = unserialize($serialized);
print_r($s2);
echo $s1 === $s2 ? 'Yes' : 'No', PHP_EOL;

/* Клонирование */
$c1 = new Abc();
$c2 = clone $c1;
echo $c1 === $c2 ? 'Yes' : 'No', PHP_EOL;
