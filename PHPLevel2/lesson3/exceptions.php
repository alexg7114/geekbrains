<?php
declare(strict_types=1);

/* Error и Throwable */
try {
    sdfsdf(); //Несуществующая функция
} catch (Error $e) {
    echo 'Error:', $e->getMessage(), "\n";
}

try {
    sdfsdf(); //Несуществующая функция
} catch (Throwable $e) {
    echo 'Throwable:', $e->getMessage(), "\n";
}

/* Пример с неправильным типом */
function foo(int $a)
{
    return $a + 1;
}
try {
    foo('123');
} catch (Throwable $e) {
    echo 'Wrong type: ' . $e->getMessage(), "\n";
}

/* Создаем и кидаем собственный exception */
class MyException extends Exception {}

function fn1() {
    fn2();
}
function fn2() {
    //try {
        fn3();
    //} catch (Exception $e) {}
}
function fn3() {
    //throw new Exception();
    $ex = new MyException();
    throw $ex;
}

try {
    fn1();
} catch (MyException $e) {
    echo 'MyException!', "\n";
} catch (Exception $e) {
    echo 'Exception!', "\n";
}

/* Какие есть данные в exception */
function bar1()
{
    bar2();
}
function bar2()
{
    throw new Exception('The my message', 1234);
}
try {
    bar1();
} catch (Exception $e) {
    print_r([
        'code' => $e->getCode(),
        'message' => $e->getMessage(),
        'file:line' => $e->getFile() . ':' . $e->getLine(),
        'trace' => $e->getTrace(),
    ]);
}

/*
 * finally - выполнится в любом слчае
 * Сначала исполнится блок finally, после этого exception продолжит "всплывать" (и мы его ловим вторым try-catch)
 */
try {
    try {
        sdfs();
    } finally {
        echo 'It is finally!', "\n";
    }
} catch (Throwable $e) {
    echo $e->getMessage();
}
