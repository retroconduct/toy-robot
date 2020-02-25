<?php

namespace App\Repositories;

use Exception;
use App\Models\ToyRobot;
use App\Models\Surface;
use App\Repositories\Contracts\ToyRobotGameRepositoryInterface;

class ToyRobotGameRepository implements ToyRobotGameRepositoryInterface
{
    /**
     * @var ToyRobot
     */
    private $toyRobot;
    /**
     * @var Surface
     */
    private $surface;

    /**
     * ToyRobotGameRepository constructor.
     * @param ToyRobot $toyRobot
     * @param Surface $surface
     */
    public function __construct(ToyRobot $toyRobot, Surface $surface)
    {
        $this->toyRobot = $toyRobot;
        $this->surface = $surface;
    }

    /**
     * @param null $posX
     * @param null $posY
     * @param null $direction
     * @return string
     */
    public function place($posX = null, $posY = null, $direction = null)
    {
        try {
            $this->toyRobot->setDirection($direction);
            $this->toyRobot->setPosX($posX);
            $this->toyRobot->setPosY($posY);
            $placed = $this->surface->place($this->toyRobot);

            if ($placed) {
                $this->toyRobot = $this->surface->getPlacedRobot();
            }
        } catch (Exception $exception) {
            return $exception->getMessage();
        }
    }

    /**
     * @return string
     */
    public function move()
    {
        try {
            if (!$this->surface->getPlacedRobot()) {
                throw new Exception('Robot not placed to move');
            }

            $direction = $this->toyRobot->getDirection();
            $directions = $this->toyRobot::DIRECTIONS;

            $posX = $this->toyRobot->getPosX();
            $posY = $this->toyRobot->getPosY();

            $axisCondition = $directions[$direction];

            if (!empty($axisCondition) && is_array($axisCondition)) {
                foreach ($axisCondition as $axis => $operator) {

                    switch ($axis) {
                        case "y":
                            switch ($operator) {
                                case "+":
                                    $posY++;
                                    break;
                                case "-":
                                    $posY--;
                                    break;
                                default:
                                    throw new Exception('Unexpected operator');
                            }
                            break;
                        case "x":
                            switch ($operator) {
                                case "+":
                                    $posX++;
                                    break;
                                case "-":
                                    $posX--;
                                    break;
                                default:
                                    throw new Exception('Unexpected operator');
                            }
                            break;
                        default:
                            throw new Exception('Unexpected axis');
                    }
                }
            }

            $newRobotState = new ToyRobot();
            $newRobotState->setPosX($posX);
            $newRobotState->setPosY($posY);
            $newRobotState->setDirection($direction);

            $placed = $this->surface->move($newRobotState, $this->toyRobot);

            if ($placed) {
                $this->toyRobot = $newRobotState;
            }
        } catch (Exception $exception) {
            return $exception->getMessage();
        }
    }

    /**
     * @return string
     */
    public function left()
    {
        try {
            $direction = $this->toyRobot->getDirection();
            $directions = $this->toyRobot::DIRECTIONS;
            $newDirection = null;
            $directionKeys = array_keys($directions);

            foreach($directionKeys as $key => $value) {

                if ($value == $direction) {
                    if (isset($directionKeys[$key - 1])) {
                        $newDirection = $directionKeys[$key - 1];
                    } else {
                        $newDirection = $directionKeys[array_key_last($directionKeys)];
                    }
                }
            }

            $this->toyRobot->setDirection($newDirection);
        } catch (Exception $exception) {
            return $exception->getMessage();
        }
    }

    /**
     * @return string
     */
    public function right()
    {
        try {
            $direction = $this->toyRobot->getDirection();
            $directions = $this->toyRobot::DIRECTIONS;
            $newDirection = null;
            $directionKeys = array_keys($directions);

            foreach($directionKeys as $key => $value) {

                if ($value == $direction) {
                    if (isset($directionKeys[$key + 1])) {
                        $newDirection = $directionKeys[$key + 1];
                    } else {
                        $newDirection = $directionKeys[array_key_first($directionKeys)];
                    }
                }
            }

            $this->toyRobot->setDirection($newDirection);
        } catch (Exception $exception) {
            return $exception->getMessage();
        }
    }

    /**
     * @return string
     */
    public function report()
    {
        try {
            if ($this->surface->getPlacedRobot()) {
                return $this->surface->getPlacedRobot()->getCurrentPosition();
            }
        } catch (Exception $exception) {
            return $exception->getMessage();
        }
    }
}
