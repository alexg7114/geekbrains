<?php
/**
 * Пример использования трейтов
 */

trait WhoAmI
{
    public function who()
    {
        return get_class($this);
    }

    public static function whoStatic()
    {
        return self::class;
    }
}

trait Screen
{
    private $screen;

    public function getScreen()
    {
        return $this->screen;
    }
}

trait Size
{
    private $size;

    public function getSize()
    {
        return $this->size;
    }
}

class Phone
{
    use Screen;
    use WhoAmI;
}

class Sofa
{
    use Size;
    use WhoAmI;
}

class TV
{
    use Screen;
    use Size;
    use WhoAmI;
}

$ph = new Phone();
$sofa = new Sofa();
$tv = new TV();

print_r([
    Phone::whoStatic(),
    Sofa::whoStatic(),
    TV::whoStatic(),
]);
