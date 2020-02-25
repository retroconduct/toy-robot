<?php

namespace App\Models;

use Exception;

class ToyRobot
{
    private $direction;
    private $posX;
    private $posY;

    const DIRECTIONS = [
        'NORTH' => ['y' => '+'],
        'EAST'  => ['x' => '+'],
        'SOUTH' => ['y' => '-'],
        'WEST'  => ['x' => '-']
    ];

    /**
     * @return mixed
     */
    public function getPosX()
    {
        return $this->posX;
    }

    /**
     * @param null $posX
     * @return int|string
     * @throws Exception
     */
    public function setPosX($posX = null)
    {
        if (!is_numeric($posX)) {
            throw new Exception('Invalid Position X for robot');
        }

        return $this->posX = $posX;
    }

    /**
     * @return mixed
     */
    public function getPosY()
    {
        return $this->posY;
    }

    /**
     * @param null $posY
     * @return int|string
     * @throws Exception
     */
    public function setPosY($posY = null)
    {
        if (!is_numeric($posY)) {
            throw new Exception('Invalid Position Y for robot');
        }

        return $this->posY = $posY;
    }

    /**
     * @return mixed
     * @throws Exception
     */
    public function getDirection()
    {
        if (isset($this->direction) && !empty($this->direction)) {
            return $this->direction;
        } else {
            throw new Exception("Robot direction not available, please place robot");
        }

    }

    /**
     * @return string
     * @throws Exception
     */
    public function getCurrentPosition()
    {
        try {
            return $this->getPosX() . "," . $this->getPosY() . "," . $this->getDirection();
        } catch (Exception $exception) {
            return $exception->getMessage();
        }

    }

    /**
     * @param null $direction
     * @return null
     * @throws Exception
     */
    public function setDirection($direction = null)
    {
        if (in_array($direction, array_keys(self::DIRECTIONS), true)) {
            return $this->direction = $direction;
        } else {
            throw new Exception("Trying to set invalid direction for Robot");
        }
    }
}
