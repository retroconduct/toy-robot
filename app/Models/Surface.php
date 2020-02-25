<?php

namespace App\Models;

use App\Models\ToyRobot;
use Exception;

class Surface
{
    const SIZE = 5;
    private $surface = [[]];
    private $placedRobot;

    /**
     * @return mixed
     */
    public function getPlacedRobot()
    {
        return $this->placedRobot;
    }

    /**
     * @param mixed $placedRobot
     */
    private function setPlacedRobot($placedRobot)
    {
        $this->placedRobot = $placedRobot;
    }

    /**
     * @param \App\Models\ToyRobot $toyRobot
     * @return bool
     * @throws Exception
     */
    public function place(ToyRobot $toyRobot)
    {
        $this->clear();
        $draw = $this->draw($toyRobot);

        if ($draw === false) {
            throw new Exception("Cannot place the robot on surface, invalid position");
        }

        return $draw;
    }

    /**
     * @param \App\Models\ToyRobot $toyRobot
     * @return bool
     */
    public function draw(ToyRobot $toyRobot)
    {
        $insideSurface = false;

        for ($y = self::SIZE - 1; $y >= 0; $y--) {
            for ($x = 0; $x < self::SIZE; $x++) {
                if (($x === intval($toyRobot->getPosX())) && ($y == intval($toyRobot->getPosY()))) {
                    $this->surface[$x][$y] = $toyRobot;
                    $this->setPlacedRobot($toyRobot);
                    $insideSurface = true;
                }
            }
        }

        return $insideSurface;
    }

    /**
     * @param \App\Models\ToyRobot $toyRobot
     * @param \App\Models\ToyRobot $previousRobotState
     * @return bool
     * @throws Exception
     */
    public function move(ToyRobot $toyRobot, ToyRobot $previousRobotState)
    {
        $draw = $this->draw($toyRobot);

        if ($draw === false) {
            $this->draw($previousRobotState);
            throw new Exception("Cannot move the robot on surface, invalid position");
        }

        return $draw;
    }

    public function clear()
    {
        for ($x = 0; $x < self::SIZE; $x++) {
            for ($y = 0; $y < self::SIZE; $y++) {
                unset($this->surface[$x][$y]);
            }
        }
    }
}
