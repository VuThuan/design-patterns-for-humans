<?php
/**
 * Created by PhpStorm.
 * User: idist
 * Date: 28/11/2018
 * Time: 20:48
 */

namespace Idist\DesignPattern\Creational\SimpleFactory;


interface Door
{
    public function getWidth(): float;

    public function getHeight(): float;
}