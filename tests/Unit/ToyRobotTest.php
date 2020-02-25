<?php

namespace Tests\Unit;

use Exception;
use Tests\TestCase;

use App\Models\ToyRobot;

/**
 * Class ToyRobot
 * @package Tests\Unit
 */
class ToyRobotTest extends TestCase
{
    private $toyRobot;

    /**
     * ToyRobotTest constructor.
     * @param null $name
     * @param array $data
     * @param string $dataName
     */
    public function __construct($name = null, array $data = [], $dataName = '')
    {
        $this->toyRobot = new ToyRobot();

        parent::__construct($name, $data, $dataName);
    }

    /**
     * @throws Exception
     */
    public function testRobotCorrectDirection()
    {
        $this->assertEquals($this->toyRobot->setDirection('SOUTH'), 'SOUTH');
        $this->assertEquals($this->toyRobot->setDirection('NORTH'), 'NORTH');
    }

    /**
     * @throws Exception
     */
    public function testRobotIncorrectDirection()
    {
        $this->expectException(Exception::class);

        $this->toyRobot->setDirection(null);
        $this->toyRobot->setDirection('NOT SURE');
        $this->toyRobot->setDirection(1);
        $this->toyRobot->setDirection('');
        $this->toyRobot->setDirection('south');
        $this->toyRobot->setDirection('SO UTH');
    }

    /**
     * @throws Exception
     */
    public function testCorrectRobotPosition()
    {
        $this->toyRobot->setPosX(0);
        $this->toyRobot->setPosX(1);
        $this->toyRobot->setPosX(4);
        $this->toyRobot->setPosY(0);
        $this->toyRobot->setPosY(1);
        $this->toyRobot->setPosY(4);
        $this->assertTrue(true);
    }

    /**
     * @throws Exception
     */
    public function testIncorrectRobotXPosition()
    {
        $this->expectException(Exception::class);

        $this->toyRobot->setPosX(null);
    }

    /**
     * @throws Exception
     */
    public function testIncorrectTypeRobotXPosition()
    {
        $this->expectException(Exception::class);

        $this->toyRobot->setPosX("test");
    }

    /**
     * @throws Exception
     */
    public function testIncorrectRobotYPosition()
    {
        $this->expectException(Exception::class);

        $this->toyRobot->setPosY(null);
    }

    /**
     * @throws Exception
     */
    public function testIncorrectTypeRobotYPosition()
    {
        $this->expectException(Exception::class);

        $this->toyRobot->setPosY("test");
    }
}
