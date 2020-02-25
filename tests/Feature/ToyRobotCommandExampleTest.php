<?php

namespace Tests\Feature;

use Tests\TestCase;

class ToyRobotCommandExampleTest extends TestCase
{
    public function testExampleA()
    {
        $this->artisan('robot:run')
            ->expectsQuestion('What is your command?', "PLACE")
            ->expectsQuestion('What is your X position?', "0")
            ->expectsQuestion('What is your Y position?', "0")
            ->expectsQuestion('What is the direction?', "NORTH")
            ->expectsQuestion('Would you like to continue?', "YES")
            ->expectsQuestion('What is your command?', "MOVE")
            ->expectsQuestion('Would you like to continue?', "YES")
            ->expectsQuestion('What is your command?', "REPORT")
            ->expectsOutput("0,1,NORTH")
            ->expectsQuestion('Would you like to continue?', "NO")
            ->assertExitCode(0);
    }

    public function testExampleB()
    {
        $this->artisan('robot:run')
            ->expectsQuestion('What is your command?', "PLACE")
            ->expectsQuestion('What is your X position?', "0")
            ->expectsQuestion('What is your Y position?', "0")
            ->expectsQuestion('What is the direction?', "NORTH")
            ->expectsQuestion('Would you like to continue?', "YES")
            ->expectsQuestion('What is your command?', "LEFT")
            ->expectsQuestion('Would you like to continue?', "YES")
            ->expectsQuestion('What is your command?', "REPORT")
            ->expectsOutput("0,0,WEST")
            ->expectsQuestion('Would you like to continue?', "NO")
            ->assertExitCode(0);
    }

    public function testExampleC()
    {
        $this->artisan('robot:run')
            ->expectsQuestion('What is your command?', "PLACE")
            ->expectsQuestion('What is your X position?', "1")
            ->expectsQuestion('What is your Y position?', "2")
            ->expectsQuestion('What is the direction?', "EAST")
            ->expectsQuestion('Would you like to continue?', "YES")
            ->expectsQuestion('What is your command?', "MOVE")
            ->expectsQuestion('Would you like to continue?', "YES")
            ->expectsQuestion('What is your command?', "MOVE")
            ->expectsQuestion('Would you like to continue?', "YES")
            ->expectsQuestion('What is your command?', "LEFT")
            ->expectsQuestion('Would you like to continue?', "YES")
            ->expectsQuestion('What is your command?', "MOVE")
            ->expectsQuestion('Would you like to continue?', "YES")
            ->expectsQuestion('What is your command?', "REPORT")
            ->expectsOutput("3,3,NORTH")
            ->expectsQuestion('Would you like to continue?', "NO")
            ->assertExitCode(0);
    }
}
