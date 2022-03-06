<?php declare(strict_types=1);

/**
 * Class Test to test the rover
 *
 * @author     Vitor Carvalho vitorthefogui@gmail.com
 * @version    v1
 * @since      06/03/2022
 */

require_once(__DIR__ . '/../../src/classes/Rover.php');
require_once(__DIR__ . '/../../src/classes/World.php');

use PHPUnit\Framework\TestCase;
use src\classes\Rover;
use src\classes\World;

final class RoverTest extends TestCase
{
    private $rover;

    protected function setUp() : void
    {
        //suposes we start at 100:100:N
        $this->rover = new Rover(100, 100, 'N');
        $world = new World(0, 0, 200, 200);
        $this->rover->setWorld($world);
    }

    public function testMoveToRightOnce() : void
    {
        $command = 'R';
        $expectedPosition = '100:100:E';
        $this->assertEquals($expectedPosition, $this->rover->executeCommand($command));
    }

    public function testMoveToRightTwice() : void
    {
        $command = 'RR';
        $expectedPosition = '100:100:S';
        $this->assertEquals($expectedPosition, $this->rover->executeCommand($command));
    }

    public function testMoveToRightThreeTimes() : void
    {
        $command = 'RRR';
        $expectedPosition = '100:100:W';
        $this->assertEquals($expectedPosition, $this->rover->executeCommand($command));
    }

    public function testMoveToRightUntilRotate() : void
    {
        $command = 'RRRR';
        $expectedPosition = '100:100:N';
        $this->assertEquals($expectedPosition, $this->rover->executeCommand($command));
    }

    public function  testMoveToLeftOnce() : void
    {
        $command = 'L';
        $expectedPosition = '100:100:W';
        $this->assertEquals($expectedPosition, $this->rover->executeCommand($command));
    }

    public function testMoveToLeftTwice() : void
    {
        $command = 'LL';
        $expectedPosition = '100:100:S';
        $this->assertEquals($expectedPosition, $this->rover->executeCommand($command));
    }

    public function testMoveToLeftThreeTimes() : void
    {
        $command = 'LLL';
        $expectedPosition = '100:100:E';
        $this->assertEquals($expectedPosition, $this->rover->executeCommand($command));
    }

    public function testMoveToLeftUntilRotate() : void
    {
        $command = 'LLLL';
        $expectedPosition = '100:100:N';
        $this->assertEquals($expectedPosition, $this->rover->executeCommand($command));
    }

    public function testMoveForwardLookingNorth() : void
    {
        $command = 'F';
        $expectedPosition = '100:99:N';
        $this->assertEquals($expectedPosition, $this->rover->executeCommand($command));
    }

    public function testMoveForwardLookingSouth() : void
    {
        $command = 'F';
        $expectedPosition = '100:101:S';
        $this->rover->setDirection('S');
        $this->rover->setCoordinate(100, 100);
        $this->assertEquals($expectedPosition, $this->rover->executeCommand($command));
    }

    public function testMoveForwardLookingWest() : void
    {
        $command = 'F';
        $expectedPosition = '99:100:W';
        $this->rover->setDirection('W');
        $this->rover->setCoordinate(100, 100);
        $this->assertEquals($expectedPosition, $this->rover->executeCommand($command));
    }

    public function testMoveForward3Times() : void
    {
        $command = 'FFF';
        $expectedPosition = '97:100:W';
        $this->rover->setDirection('W');
        $this->rover->setCoordinate(100, 100);
        $this->assertEquals($expectedPosition, $this->rover->executeCommand($command));
    }

    public function testMoveForwardLookingEast() : void
    {
        $command = 'F';
        $expectedPosition = '101:100:E';
        $this->rover->setDirection('E');
        $this->rover->setCoordinate(100, 100);
        $this->assertEquals($expectedPosition, $this->rover->executeCommand($command));
    }

    public function testStopAtObstacle() : void
    {
        $world = new World(0, 0, 10, 10);
        $world->addAnObstacle(0, 4);
        $rover = new Rover(0, 0, 'N');
        $rover->setWorld($world);
        $expectedPosition = 'P=0:3:S,O=0:4';
        $expectedObstaclePosition = '0:4';
        $command = 'RRFFFF';

        $this->assertEquals($expectedPosition, $rover->executeCommand($command));
    }

    public function testFoundObstacleAt24StartingAt55() : void
    {
        $world = new World(0, 0, 10, 10);
        $world->addAnObstacle(2, 4);
        $rover = new Rover(5, 5, 'S');
        $rover->setWorld($world);
        $expectedPosition = 'P=2:5:N,O=2:4';
        $expectedObstaclePosition = '0:4';
        $command = 'RFFFRF';

        $this->assertEquals($expectedPosition, $rover->executeCommand($command));
    }
}