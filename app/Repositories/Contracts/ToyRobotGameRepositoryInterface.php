<?php
namespace App\Repositories\Contracts;

interface ToyRobotGameRepositoryInterface
{
    /**
     * @return mixed
     */
    function place();

    /**
     * @return mixed
     */
    function move();

    /**
     * @return mixed
     */
    function left();

    /**
     * @return mixed
     */
    function right();

    /**
     * @return mixed
     */
    function report();
}
