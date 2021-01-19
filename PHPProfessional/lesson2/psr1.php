<?php
/**
 * Пример оформления кода по PSR-1
 */

class Foo
{
    public $fooBar;

    public function aboutMe($one, $two, $three)
    {
        $fooBar = 234;

        if ($a > 10 && $c < 10) {
            //code
        } else {
            //code
        }

        foreach ($a as $b) {
            //code
        }

        for ($i = 0; $i <= 10; $i++) {
            //code
        }

        if (
            $a > 5
            && $b < 10
            && $c === 0
        ) {
            //code
        }

        $arr = [
            'sdfsdfsdf2',
            'sdfsdfsdf',
            'sdfsdfsdf3',
            'sdfsdfsdf4',
            'dfgdfgdfgdfg',
            'sdfsdfsdf1',
        ];

        //$arr = array(); <- так нельзя
        $arr = [];
    }
}
