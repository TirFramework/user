<?php

namespace Tir\User;


use Illuminate\Support\ServiceProvider;
use Tir\Crud\Support\Module\Module;
use Tir\Crud\Support\Module\Modules;
use Tir\User\Database\Seeders\DatabaseSeeder;
use Tir\User\Middlewares\IsAdmin;
use Tir\User\Providers\SeedServiceProvider;

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
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
//        $this->loadRoutesFrom(__DIR__ . '/Routes/public.php');

        $this->loadRoutesFrom(__DIR__ . '/Routes/admin.php');

        $this->loadMigrationsFrom(__DIR__ . '/Database/Migrations');

        $this->loadViewsFrom(__DIR__ . '/Resources/Views', 'user');

        $this->loadTranslationsFrom(__DIR__ . '/Resources/Lang/', 'user');

        $this->app->register(SeedServiceProvider::class);

        $this->registerModule();

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
        $menu->item('system.users.user')->title('user::panel.user')->route('admin.user.index')->add();
    }

    private function registerModule()
    {
        $user = new Module();
        $user->setName('user');
        $user->setSeeders([DatabaseSeeder::class]);
        $user->enable();

        Modules::register($user);
    }
}
