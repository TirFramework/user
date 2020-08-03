<?php

namespace Tir\User;


use Tir\User\Middlewares\IsAdmin;
use Illuminate\Support\ServiceProvider;
use Tir\User\Console\UserMigrateCommand;

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
        if (! config('app.installed')) {
            return;
        }
        $this->loadRoutesFrom(__DIR__.'/Routes/public.php');
        $this->loadRoutesFrom(__DIR__.'/Routes/admin.php');

        $this->loadMigrationsFrom(__DIR__ .'/Database/Migrations');

        $this->loadViewsFrom(__DIR__.'/Resources/Views', 'user');

        $this->loadTranslationsFrom(__DIR__.'/Resources/Lang/', 'user');

        $this->adminMenu();
    }

    /**
     * Add menu.
     *
     * @return void
     */
    private function adminMenu()
    {
        $menu = resolve('AdminMenu');
        $menu->item('system')->title('user::panel.system')->link('#')->add();
        $menu->item('system.users')->title('user::panel.users')->link('#')->add();
        $menu->item('system.users.user')->title('user::panel.user')->route('user.index')->add();
    }
}
