<?php

/**
 * This class can be used to instance a new Wolrld and to add obstacles to it
 *
 * @author     Vitor Carvalho vitorthefogui@gmail.com
 * @version    v1
 * @since      06/03/2022
 */

namespace src\classes;

require_once(__DIR__ . '/Obstacle.php');

class World {
    private $minX;
    private $minY;
    private $maxX;
    private $maxY;
    private $obstacles;

    function __construct($minX, $minY, $maxX, $maxY)
    {
        $this->minX = $minX;
        $this->minY = $minY;
        $this->maxX = $maxX;
        $this->maxY = $maxY;
        $this->obstacles = array();
    }

    public function isEdge($x, $y)
    {
        return $x < $this->minX || $x == $this->maxX ||
                $y < $this->minY || $y == $this->maxY;
    }

    public function isObstacle($x, $y)
    {
        $isEdge = $this->isEdge($x, $y);

        $isObstacle = false;
        $i = 0;
        $totalObstacles = count($this->obstacles);

        while ($i < $totalObstacles && !$isObstacle) {
            $isObstacle = $this->obstacles[$i]->isObstacle($x, $y);

            $i = $i + 1;
        }

        return $isEdge || $isObstacle;
    }

    public function addAnObstacle($x, $y) {
        $obstacle = new Obstacle($x, $y);
        array_push($this->obstacles, $obstacle);
    }

    public function generateRandomObstacles($total)
    {
        for ($i = 0; $i < $total; $i = $i + 1) {
            $randomX = rand($this->minX, $this->maxX);
            $randomY = rand($this->minY, $this->maxY);

            $this->addAnObstacle($randomX, $randomY);
        }
    }

    public function getObstacles()
    {
        return $this->obstacles;
    }
}