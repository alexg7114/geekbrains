<?php
//Присвоение простых типов, объектов, сериализация, клонирование

class Abc
{
    public $str = 'text';
}

//Обычное присвоение
$i = 5;
$j = $i;
$j += 3;
echo $i, ' ', $j, "\n";

//Присвоение по ссылке
$i = 5;
$j = &$i;
$j += 3;
echo $i, ' ', $j, "\n";

//Присвоение объектов - всегда по ссылке
$abc = new Abc();
$abc2 = $abc;
$abc2->str = 'another text';
print_r([
    $abc->str,
    $abc2->str,
]);

//Обычная передача в функцию
function modifyVar($i)
{
    $i += 2;
}

$a = 4;
modifyVar($a);
echo $a, "\n";

//Передача в функцию по ссылке
function modifyVarLink(&$i)
{
    $i += 2;
}

$a = 4;
modifyVarLink($a);
echo $a, "\n";

//Объекты всегда передаются по ссылке
$obj = new Abc();
function modifyStr($o)
{
    $o->str = 'from function';
}

modifyStr($obj);
echo $obj->str, "\n";

//Сериализация
$obj1 = new Abc();
$obj2 = $obj1;
echo $obj1 === $obj2 ? 'true' : 'false', "\n";

$obj3 = new Abc();
$ser = serialize($obj3);
echo $ser, "\n";
$obj4 = unserialize($ser);
print_r([$obj3, $obj4]);
echo $obj3 === $obj4 ? 'true' : 'false', "\n";

//Клонирование
$obj5 = new Abc();
$obj6 = clone $obj5;
print_r([$obj5, $obj6]);
echo $obj5 === $obj6 ? 'true' : 'false', "\n";
