<?php

namespace Tests\Unit;

use Exception;
use Tests\TestCase;

use App\Models\Surface;
use App\Models\ToyRobot;

/**
 * Class SurfaceTest
 * @package Tests\Unit
 */
class SurfaceTest extends TestCase
{
    private $toyRobot;
    private $surface;

    /**
     * SurfaceTest constructor.
     * @param null $name
     * @param array $data
     * @param string $dataName
     */
    public function __construct($name = null, array $data = [], $dataName = '')
    {
        $this->toyRobot = new ToyRobot();
        $this->surface = new Surface();

        parent::__construct($name, $data, $dataName);
    }

    /**
     * @throws Exception
     */
    public function testPlaceRobotInside()
    {
        $this->toyRobot->setPosX(0);
        $this->toyRobot->setPosY(0);
        $this->toyRobot->setDirection("NORTH");
        $this->assertTrue($this->surface->place($this->toyRobot));

        $this->toyRobot->setPosX(4);
        $this->toyRobot->setPosY(4);
        $this->toyRobot->setDirection("SOUTH");
        $this->assertTrue($this->surface->place($this->toyRobot));


        $this->toyRobot->setPosX(0);
        $this->toyRobot->setPosY(4);
        $this->toyRobot->setDirection("WEST");
        $this->assertTrue($this->surface->place($this->toyRobot));
    }

    /**
     * @throws Exception
     */
    public function testPlaceRobotOutside()
    {
        $this->expectException(Exception::class);

        $this->toyRobot->setPosX(-1);
        $this->toyRobot->setPosY(0);
        $this->surface->place($this->toyRobot);
        $this->toyRobot->setPosX(-1);
        $this->toyRobot->setPosY(-1);
        $this->surface->place($this->toyRobot);
        $this->toyRobot->setPosX(5);
        $this->toyRobot->setPosY(0);
        $this->surface->place($this->toyRobot);
        $this->toyRobot->setPosX(0);
        $this->toyRobot->setPosY(5);
        $this->surface->place($this->toyRobot);
        $this->toyRobot->setPosX(5);
        $this->toyRobot->setPosY(8);
        $this->surface->place($this->toyRobot);
    }
}
