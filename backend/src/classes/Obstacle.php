<?php
/**
 * This class is used to create Obstacles in the world.
 *
 * @author     Vitor Carvalho vitorthefogui@gmail.com
 * @version    v1
 * @since      06/03/2022
 */

namespace src\classes;

require_once(__DIR__ . '/Coordinate.php');

class Obstacle {
    private $coordinate;

    function __construct($x, $y) {
        $this->coordinate = new Coordinate($x, $y);
    }

    public function isObstacle($x, $y) {
        return $this->coordinate->getX() === $x && $this->coordinate->getY() === $y;
    }
}