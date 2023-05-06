<?php

namespace App\Providers;


use App\Http\Controllers\api\v1\auth\dao\UserRepository;
use App\Http\Controllers\api\v1\auth\dao\UserRepositoryInterface;
use App\Http\Controllers\api\v1\master\dao\MasterKendaraanRepository;
use App\Http\Controllers\api\v1\master\dao\MasterKendaraanRepositoryInterface;
use App\Http\Controllers\api\v1\master\dao\MasterMobilRepository;
use App\Http\Controllers\api\v1\master\dao\MasterMobilRepositoryInterface;
use App\Http\Controllers\api\v1\master\dao\MasterMotorRepository;
use App\Http\Controllers\api\v1\master\dao\MasterMotorRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\DatabasePresenceVerifier;
use Illuminate\Validation\PresenceVerifierInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Register bind validation requests
        $this->app->bind(
            PresenceVerifierInterface::class,
            DatabasePresenceVerifier::class
        );

        // Register bind repository patterns
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(MasterKendaraanRepositoryInterface::class, MasterKendaraanRepository::class);
        $this->app->bind(MasterMobilRepositoryInterface::class, MasterMobilRepository::class);
        $this->app->bind(MasterMotorRepositoryInterface::class, MasterMotorRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
