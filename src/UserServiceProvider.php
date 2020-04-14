<?php

namespace Tir\User;


use Tir\User\Middlewares\IsAdmin;
use Illuminate\Support\ServiceProvider;
use Tir\User\Console\UserMigrateCommand;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

class UserServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */

    public function register()
    {
        $this->app['router']->aliasMiddleware('IsAdmin', IsAdmin::class);


        $this->commands([
            UserMigrateCommand::class
        ]);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $credentials = [
            'email'    => 'admin@tir.local',
            'password' => '123456',
        ];

        Sentinel::authenticate($credentials);

        $this->loadRoutesFrom(__DIR__.'/Routes/admin.php');

        $this->loadRoutesFrom(__DIR__.'/Routes/web.php');

        $this->loadMigrationsFrom(__DIR__ .'/Database/Migrations');

        $this->loadViewsFrom(__DIR__.'/Resources/Views', 'user');

        $this->loadTranslationsFrom(__DIR__.'/Resources/Lang/', 'user');

    }
}
