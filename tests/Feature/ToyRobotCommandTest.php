<?php

namespace Tests\Feature;

use Tests\TestCase;

class ToyRobotCommandTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testReportBeforePlacingRobot()
    {
        $this->artisan('robot:run')
            ->expectsQuestion('What is your command?', "REPORT")
            ->expectsQuestion('Would you like to continue?', "NO")
            ->assertExitCode(0);
    }

    public function testLeftBeforePlacingRobot()
    {
        $this->artisan('robot:run')
            ->expectsQuestion('What is your command?', "LEFT")
            ->expectsQuestion('Would you like to continue?', "NO")
            ->assertExitCode(0);
    }

    public function testRightBeforePlacingRobot()
    {
        $this->artisan('robot:run')
            ->expectsQuestion('What is your command?', "RIGHT")
            ->expectsQuestion('Would you like to continue?', "NO")
            ->assertExitCode(0);
    }

    public function testMoveBeforePlacingRobot()
    {
        $this->artisan('robot:run')
            ->expectsQuestion('What is your command?', "MOVE")
            ->expectsQuestion('Would you like to continue?', "NO")
            ->assertExitCode(0);
    }

    public function testPlaceOutOfSurfaceNegative()
    {
        $this->artisan('robot:run')
            ->expectsQuestion('What is your command?', "PLACE")
            ->expectsQuestion('What is your X position?', "-1")
            ->expectsQuestion('What is your Y position?', "-1")
            ->expectsQuestion('What is the direction?', "SOUTH")
            ->expectsQuestion('Would you like to continue?', "NO")
            ->assertExitCode(0);
    }

    public function testPlaceOutOfSurfacePositive()
    {
        $this->artisan('robot:run')
            ->expectsQuestion('What is your command?', "PLACE")
            ->expectsQuestion('What is your X position?', "60")
            ->expectsQuestion('What is your Y position?', "4")
            ->expectsQuestion('What is the direction?', "SOUTH")
            ->expectsQuestion('Would you like to continue?', "NO")
            ->assertExitCode(0);
    }

    public function testMoveRobotOutOfSurface()
    {
        $this->artisan('robot:run')
            ->expectsQuestion('What is your command?', "PLACE")
            ->expectsQuestion('What is your X position?', "0")
            ->expectsQuestion('What is your Y position?', "0")
            ->expectsQuestion('What is the direction?', "SOUTH")
            ->expectsQuestion('Would you like to continue?', "YES")
            ->expectsQuestion('What is your command?', "MOVE")
            ->expectsQuestion('Would you like to continue?', "YES")
            ->expectsQuestion('What is your command?', "REPORT")
            ->expectsOutput("0,0,SOUTH")
            ->expectsQuestion('Would you like to continue?', "NO")
            ->assertExitCode(0);
    }

    public function testMoveRobotOutOfSurfaceYAxis()
    {
        $this->artisan('robot:run')
            ->expectsQuestion('What is your command?', "PLACE")
            ->expectsQuestion('What is your X position?', "0")
            ->expectsQuestion('What is your Y position?', "4")
            ->expectsQuestion('What is the direction?', "NORTH")
            ->expectsQuestion('Would you like to continue?', "YES")
            ->expectsQuestion('What is your command?', "MOVE")
            ->expectsQuestion('Would you like to continue?', "YES")
            ->expectsQuestion('What is your command?', "REPORT")
            ->expectsOutput("0,4,NORTH")
            ->expectsQuestion('Would you like to continue?', "NO")
            ->assertExitCode(0);
    }

    public function testMoveRobotOutOfSurfaceXAxis()
    {
        $this->artisan('robot:run')
            ->expectsQuestion('What is your command?', "PLACE")
            ->expectsQuestion('What is your X position?', "4")
            ->expectsQuestion('What is your Y position?', "0")
            ->expectsQuestion('What is the direction?', "EAST")
            ->expectsQuestion('Would you like to continue?', "YES")
            ->expectsQuestion('What is your command?', "MOVE")
            ->expectsQuestion('Would you like to continue?', "YES")
            ->expectsQuestion('What is your command?', "REPORT")
            ->expectsOutput("4,0,EAST")
            ->expectsQuestion('Would you like to continue?', "NO")
            ->assertExitCode(0);
    }

    public function testTurnLeft90()
    {
        $this->artisan('robot:run')
            ->expectsQuestion('What is your command?', "PLACE")
            ->expectsQuestion('What is your X position?', "3")
            ->expectsQuestion('What is your Y position?', "3")
            ->expectsQuestion('What is the direction?', "NORTH")
            ->expectsQuestion('Would you like to continue?', "YES")
            ->expectsQuestion('What is your command?', "LEFT")
            ->expectsQuestion('Would you like to continue?', "YES")
            ->expectsQuestion('What is your command?', "REPORT")
            ->expectsOutput("3,3,WEST")
            ->expectsQuestion('Would you like to continue?', "NO")
            ->assertExitCode(0);
    }

    public function testTurnLeft180()
    {
        $this->artisan('robot:run')
            ->expectsQuestion('What is your command?', "PLACE")
            ->expectsQuestion('What is your X position?', "3")
            ->expectsQuestion('What is your Y position?', "3")
            ->expectsQuestion('What is the direction?', "NORTH")
            ->expectsQuestion('Would you like to continue?', "YES")
            ->expectsQuestion('What is your command?', "LEFT")
            ->expectsQuestion('Would you like to continue?', "YES")
            ->expectsQuestion('What is your command?', "LEFT")
            ->expectsQuestion('Would you like to continue?', "YES")
            ->expectsQuestion('What is your command?', "REPORT")
            ->expectsOutput("3,3,SOUTH")
            ->expectsQuestion('Would you like to continue?', "NO")
            ->assertExitCode(0);
    }

    public function testTurnRight90()
    {
        $this->artisan('robot:run')
            ->expectsQuestion('What is your command?', "PLACE")
            ->expectsQuestion('What is your X position?', "3")
            ->expectsQuestion('What is your Y position?', "3")
            ->expectsQuestion('What is the direction?', "NORTH")
            ->expectsQuestion('Would you like to continue?', "YES")
            ->expectsQuestion('What is your command?', "RIGHT")
            ->expectsQuestion('Would you like to continue?', "YES")
            ->expectsQuestion('What is your command?', "REPORT")
            ->expectsOutput("3,3,EAST")
            ->expectsQuestion('Would you like to continue?', "NO")
            ->assertExitCode(0);
    }

    public function testTurnRight180()
    {
        $this->artisan('robot:run')
            ->expectsQuestion('What is your command?', "PLACE")
            ->expectsQuestion('What is your X position?', "3")
            ->expectsQuestion('What is your Y position?', "3")
            ->expectsQuestion('What is the direction?', "NORTH")
            ->expectsQuestion('Would you like to continue?', "YES")
            ->expectsQuestion('What is your command?', "RIGHT")
            ->expectsQuestion('Would you like to continue?', "YES")
            ->expectsQuestion('What is your command?', "RIGHT")
            ->expectsQuestion('Would you like to continue?', "YES")
            ->expectsQuestion('What is your command?', "REPORT")
            ->expectsOutput("3,3,SOUTH")
            ->expectsQuestion('Would you like to continue?', "NO")
            ->assertExitCode(0);
    }

    public function testMoveFromCornerToCorner()
    {
        $this->artisan('robot:run')
            ->expectsQuestion('What is your command?', "PLACE")
            ->expectsQuestion('What is your X position?', "0")
            ->expectsQuestion('What is your Y position?', "0")
            ->expectsQuestion('What is the direction?', "NORTH")
            ->expectsQuestion('Would you like to continue?', "YES")
            ->expectsQuestion('What is your command?', "MOVE")
            ->expectsQuestion('Would you like to continue?', "YES")
            ->expectsQuestion('What is your command?', "MOVE")
            ->expectsQuestion('Would you like to continue?', "YES")
            ->expectsQuestion('What is your command?', "MOVE")
            ->expectsQuestion('Would you like to continue?', "YES")
            ->expectsQuestion('What is your command?', "MOVE")
            ->expectsQuestion('Would you like to continue?', "YES")
            ->expectsQuestion('What is your command?', "RIGHT")
            ->expectsQuestion('Would you like to continue?', "YES")
            ->expectsQuestion('What is your command?', "MOVE")
            ->expectsQuestion('Would you like to continue?', "YES")
            ->expectsQuestion('What is your command?', "MOVE")
            ->expectsQuestion('Would you like to continue?', "YES")
            ->expectsQuestion('What is your command?', "MOVE")
            ->expectsQuestion('Would you like to continue?', "YES")
            ->expectsQuestion('What is your command?', "MOVE")
            ->expectsQuestion('Would you like to continue?', "YES")
            ->expectsQuestion('What is your command?', "REPORT")
            ->expectsOutput("4,4,EAST")
            ->expectsQuestion('Would you like to continue?', "NO")
            ->assertExitCode(0);
    }

    public function testMoveFromCornerToCorner2()
    {
        $this->artisan('robot:run')
            ->expectsQuestion('What is your command?', "PLACE")
            ->expectsQuestion('What is your X position?', "4")
            ->expectsQuestion('What is your Y position?', "4")
            ->expectsQuestion('What is the direction?', "SOUTH")
            ->expectsQuestion('Would you like to continue?', "YES")
            ->expectsQuestion('What is your command?', "MOVE")
            ->expectsQuestion('Would you like to continue?', "YES")
            ->expectsQuestion('What is your command?', "MOVE")
            ->expectsQuestion('Would you like to continue?', "YES")
            ->expectsQuestion('What is your command?', "MOVE")
            ->expectsQuestion('Would you like to continue?', "YES")
            ->expectsQuestion('What is your command?', "MOVE")
            ->expectsQuestion('Would you like to continue?', "YES")
            ->expectsQuestion('What is your command?', "RIGHT")
            ->expectsQuestion('Would you like to continue?', "YES")
            ->expectsQuestion('What is your command?', "MOVE")
            ->expectsQuestion('Would you like to continue?', "YES")
            ->expectsQuestion('What is your command?', "MOVE")
            ->expectsQuestion('Would you like to continue?', "YES")
            ->expectsQuestion('What is your command?', "MOVE")
            ->expectsQuestion('Would you like to continue?', "YES")
            ->expectsQuestion('What is your command?', "MOVE")
            ->expectsQuestion('Would you like to continue?', "YES")
            ->expectsQuestion('What is your command?', "REPORT")
            ->expectsOutput("0,0,WEST")
            ->expectsQuestion('Would you like to continue?', "NO")
            ->assertExitCode(0);
    }
}
