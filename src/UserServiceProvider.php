<?php

namespace Tir\User;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Tir\User\Contracts\Authentication;
use Tir\User\Sentinel\SentinelAuthentication;
use Tir\User\Middlewares\IsAdmin;
use Illuminate\Support\ServiceProvider;
use Tir\User\Console\UserMigrateCommand;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Tir\User\Middlewares\IsGuest;
use Tir\User\Middlewares\IsUser;

class UserServiceProvider extends ServiceProvider
{


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

        $this->registerSentinelGuard();

        $this->registerBladeDirectives();
        $this->adminMenu();
    }


    /**
     * Register any application services.
     *
     * @return void
     */

    public function register()
    {
        $this->loadRoutesFrom(__DIR__.'/Routes/auth.php');
        $this->loadRoutesFrom(__DIR__.'/Routes/admin.php');
        $this->loadMigrationsFrom(__DIR__ .'/Database/Migrations');
        $this->loadViewsFrom(__DIR__.'/Resources/Views', 'user');
        $this->loadTranslationsFrom(__DIR__.'/Resources/Lang/', 'user');


        $this->app['router']->aliasMiddleware('IsAdmin', IsAdmin::class);
        $this->app['router']->aliasMiddleware('IsUser',  IsUser::class);
        $this->app['router']->aliasMiddleware('IsGuest', IsGuest::class);


        $this->commands([
            UserMigrateCommand::class
        ]);

        $this->app->bind(Authentication::class, SentinelAuthentication::class);

    }

    /**
     * Register sentinel guard.
     *
     * @return void
     */
    private function registerSentinelGuard()
    {
        Auth::extend('sentinel', function () {
            return new \Tir\User\Guards\Sentinel;
        });
    }

    /**
     * Register blade directives.
     *
     * @return void
     */
    private function registerBladeDirectives()
    {
        Blade::directive('hasAccess', function ($permissions) {
            return "<?php if (\$currentUser->hasAccess($permissions)) : ?>";
        });

        Blade::directive('endHasAccess', function () {
            return '<?php endif; ?>';
        });

        Blade::directive('hasAnyAccess', function ($permissions) {
            return "<?php if (\$currentUser->hasAnyAccess($permissions)) : ?>";
        });

        Blade::directive('endHasAnyAccess', function () {
            return '<?php endif; ?>';
        });
    }

    private function adminMenu()
    {
        $menu = resolve('AdminMenu');
        $menu->item('system')->title('user::panel.system')->link('#')->add();
        $menu->item('system.users')->title('user::panel.users')->route('user.index')->add();
    }

}
