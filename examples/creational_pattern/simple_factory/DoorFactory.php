<?php
/**
 * Created by PhpStorm.
 * User: idist
 * Date: 28/11/2018
 * Time: 20:50
 */

namespace Idist\DesignPattern\Creational\SimpleFactory;


class DoorFactory
{
    public static function makeDoor($width, $height): Door
    {
        return new WoodenDoor($width, $height);
    }
}