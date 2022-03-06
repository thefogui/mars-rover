<?php
/**
 * this file is used to define all posibles actions the rover can perform.
 *
 * @author     Vitor Carvalho vitorthefogui@gmail.com
 * @version    v1
 * @since      06/03/2022
 */

namespace src\classes;

require_once(__DIR__ . '/../config/Config.php');
require_once(__DIR__ . '/Coordinate.php');

use config\Config;

class Action {
    protected $nextDirection;
    protected $coordinate;

    protected function getFormatedPosition($direction)
    {
        return $this->coordinate->getX() . ':' .
               $this->coordinate->getY() . ':' .
               $direction;
    }

    public function getNextPosition($x, $y, $direction)
    {
        return $x . ':' . $y . ':' . $this->nextDirection;
    }
}

class RightAction extends Action {
    public function getNextPosition($x, $y, $direction)
    {
        $this->coordinate = new Coordinate($x, $y);

        if ($direction === Config::NORTH) return $this->getFormatedPosition(Config::EAST);
        if ($direction === Config::EAST) return $this->getFormatedPosition(Config::SOUTH);
        if ($direction === Config::SOUTH) return $this->getFormatedPosition(Config::WEST);

        return $this->getFormatedPosition(Config::NORTH);
    }
}

class LeftAction extends Action {
    public function getNextPosition($x, $y, $direction)
    {
        $this->coordinate = new Coordinate($x, $y);

        if ($direction === Config::NORTH) return $this->getFormatedPosition(Config::WEST);
        if ($direction === Config::WEST) return $this->getFormatedPosition(Config::SOUTH);
        if ($direction === Config::SOUTH) return $this->getFormatedPosition(Config::EAST);

        return $this->getFormatedPosition(Config::NORTH);
    }
}

class ForwardAction extends Action {
    public function getNextPosition($x, $y, $direction)
    {
        $this->coordinate = new Coordinate($x, $y);
        $newX = $x;
        $newY = $y;

        if ($direction == Config::NORTH) {
            $newY = $newY - 1;
        } else if ($direction == Config::WEST) {
            $newX = $newX - 1;
        } else if ($direction == Config::SOUTH) {
            $newY = $newY + 1;
        } else if ($direction == Config::EAST) {
            $newX = $newX + 1;
        }

        $this->coordinate->setX($newX);
        $this->coordinate->setY($newY);

        return $this->getFormatedPosition($direction);
    }
}

class ActionFactory {
    public static function getAction($action)
    {
        switch ($action) {
            case Config::RIGHT:
                return new RightAction();
            case Config::LEFT:
                return new LeftAction();
            case Config::FORWARD:
                return new forwardAction();
        }
    }
}