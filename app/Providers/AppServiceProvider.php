<?php

namespace App\Providers;


use App\Http\Controllers\api\v1\auth\dao\UserRepository;
use App\Http\Controllers\api\v1\auth\dao\UserRepositoryInterface;
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
