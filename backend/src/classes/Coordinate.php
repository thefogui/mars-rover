<?php
/**
 * This class saves one coordinate in the weird world
 *
 * @author     Vitor Carvalho vitorthefogui@gmail.com
 * @version    v1
 * @since      06/03/2022
 */

namespace src\classes;

class Coordinate {
    private $x;
    private $y;

    function __construct($x, $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    public function setX($x)
    {
        $this->x = $x;
    }

    public function getX()
    {
       return $this->x;
    }

    public function setY($y)
    {
        $this->y = $y;
    }

    public function getY()
    {
       return $this->y;
    }
}