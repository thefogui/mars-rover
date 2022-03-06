<?php declare(strict_types=1);
/**
 * Class Test to test the obstacle
 *
 * @author     Vitor Carvalho vitorthefogui@gmail.com
 * @version    v1
 * @since      06/03/2022
 */

require_once(__DIR__ . '/../../src/classes/Obstacle.php');

use PHPUnit\Framework\TestCase;
use src\classes\Obstacle;

final class ObstacleTest extends TestCase
{
    private $obstacle;

    protected function setUp() : void
    {
        $this->obstacle = new Obstacle(0, 0);
    }

    public function testIsObstacle() : void
    {
        $this->assertTrue($this->obstacle->isObstacle(0, 0), "Is not an obstacle");
    }

    public function testIsNotAnObstacle() : void
    {
        $this->assertFalse($this->obstacle->isObstacle(1, 0), "Is an obstacle");
    }

    public function testIsNotAnObstacleXY() : void
    {
        $this->assertFalse($this->obstacle->isObstacle(1, 1), "Is an obstacle");
    }
}