<?php
/**
 * This class is the rover
 *
 * @author     Vitor Carvalho vitorthefogui@gmail.com
 * @version    v1
 * @since      06/03/2022
 */

namespace src\classes;

require_once(__DIR__ . '/../config/Config.php');
require_once(__DIR__ . '/Coordinate.php');
require_once(__DIR__ . '/Action.php');

use config\Config;

class Rover {
    private $coordinate;
    private $direction;
    private $world;

    function __construct($x, $y, $direction)
    {
        $this->coordinate = new Coordinate($x, $y);
        $this->direction = $direction;
    }

    public function executeCommand($command)
    {
        $this->output = '';
        $commandArr = str_split($command);

        foreach ($commandArr as $action) {
            $position = $this->moveToDirection($action);

            $newCoordinate = explode(':', $position);
            $newX = intval($newCoordinate[0]);
            $newY = intval($newCoordinate[1]);
            $this->direction = $newCoordinate[2];

            if ($this->isACorrectMovement($newX, $newY)) {
                $this->setCoordinate($newX, $newY);
            } else {
                return 'P=' . $this->coordinate->getX() . ':' .
                    $this->coordinate->getY() . ':' . $this->direction . ',O=' .
                    $newX . ':' . $newY;
            }
        }

        return $position;
    }

    private function moveToDirection($action)
    {
        $action = ActionFactory::getAction($action);
        $x = $this->coordinate->getX();
        $y = $this->coordinate->getY();
        return $action->getNextPosition($x, $y, $this->direction);
    }

    public function isACorrectMovement($nextX, $nextY)
    {
        return !$this->world->isObstacle($nextX, $nextY);
    }

    public function setCoordinate($x, $y)
    {
        $this->coordinate->setX($x);
        $this->coordinate->setY($y);
    }

    public function setDirection($direction)
    {
        $this->direction = $direction;
    }

    public function setWorld($world)
    {
        $this->world = $world;
    }
}
