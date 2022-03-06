<?php declare(strict_types=1);
/**
 * Class Test to test the World
 *
 * @author     Vitor Carvalho vitorthefogui@gmail.com
 * @version    v1
 * @since      06/03/2022
 */

require_once(__DIR__ . '/../../src/classes/World.php');

use PHPUnit\Framework\TestCase;
use src\classes\World;

final class WorldTest extends TestCase
{
    private $world;

    protected function setUp() : void
    {
        $this->world = new World(0, 0, 200, 200);
    }

    public function testIsEdgeWhenXIsNegative() : void
    {
        $obtainedValue = $this->world->isEdge(-1, 0);
        $this->assertTrue($obtainedValue, "Is not an edge 1!");
    }

    public function testIsEdgeWhenYIsNegative() : void
    {
        $obtainedValue = $this->world->isEdge(0, -1);
        $this->assertTrue($obtainedValue, "Is not an edge 3!");
    }

    public function testIsEdgeWhenXIsOnLimit() : void
    {
        $obtainedValue = $this->world->isEdge(200, 0);
        $this->assertTrue($obtainedValue, "Is not an edge 2!");
    }

    public function testIsEdgeWhenYIsOnLimit() : void
    {
        $obtainedValue = $this->world->isEdge(0, 200);
        $this->assertTrue($obtainedValue, "Is not an edge 4!");
    }

    public function testIsNotAnEdge() : void
    {
        $obtainedValue = $this->world->isEdge(0, 0);
        $this->assertFalse($obtainedValue, "Is an edge!");
    }

    public function testGetAllAvailableCoordinates() : void
    {
        $expectedNumberOfCoordinates = strval(200 * 200);
        $totalNumberOfCoordinates = 0;
        for ($x = 0; $x < 200; $x += 1) {
            for ($y = 0; $y < 200; $y += 1) {
                if (!$this->world->isEdge($x, $y)) {
                    $totalNumberOfCoordinates = $totalNumberOfCoordinates + 1;
                }
            }
        }
        $totalNumberOfCoordinates = strval($totalNumberOfCoordinates);
        $this->assertEquals($expectedNumberOfCoordinates, $totalNumberOfCoordinates);
    }

    public function testGenerateRandomObstacles() : void
    {
        $numberOfObstacles = 20;
        $expectedNumberOfObstacles = strval($numberOfObstacles);
        $this->world->generateRandomObstacles($numberOfObstacles);
        $obstacles = $this->world->getObstacles();
        $numberOfgeneratedObstacles = strval(count($obstacles));
        $this->assertEquals($expectedNumberOfObstacles, $numberOfgeneratedObstacles);
    }
}