<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\Tenongan\TenonganService as TenonganServiceContract;
use App\Services\Tenongan\TenonganService;

class TenonganServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind(TenonganServiceContract::class, TenonganService::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
