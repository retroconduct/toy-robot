<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Repositories\Contracts\ToyRobotGameRepositoryInterface;
use App\Repositories\ToyRobotGameRepository;

class ToyRobotGameServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ToyRobotGameRepositoryInterface::class, ToyRobotGameRepository::class);
    }
}
