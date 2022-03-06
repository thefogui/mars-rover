<?php
/**
 * This is the controller of the api, should be separated  in the future.
 *
 * @author     Vitor Carvalho vitorthefogui@gmail.com
 * @version    v1
 * @since      06/03/2022
 */

require_once(__DIR__  . '/../classes/Rover.php');
require_once(__DIR__  . '/../classes/World.php');
require_once(__DIR__  . '/../classes/Obstacle.php');

use src\classes\Rover;
use src\classes\World;
use src\classes\Obstacle;

class Controller {
    private $rover;
    private $world;

    public function __construct()
    {

    }

    public function add($x, $y, $direction)
    {
        $x = intval($x);
        $y = intval($y);
        $this->rover = new Rover($x, $y, $direction);

        return json_encode(array('success' => 'Rover created successfully'));
    }

    public function addworld($minx, $maxx, $miny, $maxy)
    {
        if (!isset($this->rover)) {
            return json_encode(array('error' => 'Rover not created'));
        }

        $minx = intval($minx);
        $miny = intval($miny);
        $maxx = intval($maxx);
        $maxy = intval($maxy);

        $this->world = new World($minx, $miny, $maxx, $maxy);
        $this->rover->setWorld($this->world);

        return json_encode(array('success' => 'World added successfully'));
    }

    public function addObstacle($x, $y)
    {
        $x = intval($x);
        $y = intval($y);
        $this->world->addAnObstacle($x, $y);
    }

    public function execute($command)
    {
        $result = $this->rover->executeCommand($command);

        if (strpos($result, '0=') !== false) {
            $response = array(
                "error" => "Rover could not executed command without obstacles",
                "position" => $result,
            );
        } else {
            $response = array(
                "succes" => "Rover executed command without obstacles",
                "position" => $result
            );
        }

        return json_encode($response);
    }

    public function explore($x, $y, $direction, $minx, $miny, $maxx, $maxy, $ox, $oy, $command)
    {
        $x = intval($x);
        $y = intval($y);
        $minx = intval($minx);
        $miny = intval($miny);
        $maxx = intval($maxx);
        $maxy = intval($maxy);
        $ox = intval($ox);
        $oy = intval($oy);

        $rover = new Rover($x, $y, $direction);
        $word = new World($minx, $miny, $maxx, $maxy);
        $rover->setWorld($word);
        $word->addAnObstacle($ox, $oy);

        $result = $rover->executeCommand($command);

        if (strpos($result, 'O=') !== false) {
            $response = array(
                "error" => "Rover could not executed command without obstacles",
                "position" => $result,
            );
        } else {
            $response = array(
                "succes" => "Rover executed command without obstacles",
                "position" => $result
            );
        }

        return json_encode($response);
    }
}
