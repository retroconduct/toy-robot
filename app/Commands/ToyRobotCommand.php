<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;

use App\Repositories\Contracts\ToyRobotGameRepositoryInterface;

class ToyRobotCommand extends Command
{
    /**
     * @var ToyRobotGameRepositoryInterface
     */
    private $toyRobotGameService;

    public function __construct(ToyRobotGameRepositoryInterface $toyRobotGameService)
    {
        $this->toyRobotGameService = $toyRobotGameService;

        parent::__construct();
    }

    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'robot:run';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Navigate a robot on a surface';

    /**
     * Execute the console command.
     *
     * @return mixed
     * @throws \Exception
     */
    public function handle()
    {
        $this->info('We are going place the robot and move it around');

        $continue = 'YES';

        do {
            $command = $this->choice('What is your command?', ['PLACE', 'MOVE', 'LEFT', 'RIGHT', 'REPORT'], 0);

            switch ($command) {
                case 'PLACE':
                    $xPos = $this->ask('What is your X position?');
                    $yPos = $this->ask('What is your Y position?');
                    $direction = $this->choice('What is the direction?', ['SOUTH', 'WEST', 'NORTH', 'EAST'], 0);
                    $this->toyRobotGameService->place($xPos, $yPos, $direction);

                    break;
                case 'MOVE':
                    $this->toyRobotGameService->move();
                    break;
                case 'LEFT':
                    $this->toyRobotGameService->left();
                    break;
                case 'RIGHT':
                    $this->toyRobotGameService->right();
                    break;
                case 'REPORT':
                    $result = $this->toyRobotGameService->report();

                    if ($result) {
                        $this->line($result);
                    }

                    break;
                default:
            }

            $continue = $this->choice('Would you like to continue?', ['YES', 'NO'], 0);

        } while ($continue == 'YES');
    }
}
