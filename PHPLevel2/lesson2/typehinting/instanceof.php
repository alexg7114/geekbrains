<?php
declare(strict_types=1);

//A -> B -> C
class A
{
}

class B extends A
{
}

class C extends B
{
}

$a = new A();
$b = new B();
$c = new C();

echo ($a instanceof A) ? '+' : '-', "\n";

echo ($b instanceof B) ? '+' : '-', "\n";
echo ($b instanceof A) ? '+' : '-', "\n";

echo ($c instanceof C) ? '+' : '-', "\n";
echo ($c instanceof B) ? '+' : '-', "\n";
echo ($c instanceof A) ? '+' : '-', "\n";
