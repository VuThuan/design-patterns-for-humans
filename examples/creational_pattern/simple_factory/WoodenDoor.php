<?php
/**
 * Created by PhpStorm.
 * User: idist
 * Date: 28/11/2018
 * Time: 20:49
 */

namespace Idist\DesignPattern\Creational\SimpleFactory;


class WoodenDoor implements Door
{
    protected $width;
    protected $height;

    public function __construct(float $width, float $height)
    {
        $this->width = $width;
        $this->height = $height;
    }

    public function getWidth(): float
    {
        return $this->width;
    }

    public function getHeight(): float
    {
        return $this->height;
    }
}