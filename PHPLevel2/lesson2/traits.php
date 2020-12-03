<?php

trait WhoAmI
{
    public function who()
    {
        return self::class;
    }
}

trait ScreenSize
{
    private $screenSize;

    public function getScreenSize()
    {
        return $this->screenSize;
    }
}

trait Gabarit
{
    private $gabarit;

    public function getGabarit()
    {
        return $this->gabarit;
    }
}

class Phone
{
    use WhoAmI, ScreenSize;
}

class Sofa
{
    use WhoAmI, Gabarit;
}

class TV
{
    use WhoAmI, ScreenSize, Gabarit;
}

$phone = new Phone();
$sofa = new Sofa();
$tv = new TV();

echo $phone->who(), "\n";
echo $sofa->who(), "\n";
echo $tv->who(), "\n";
