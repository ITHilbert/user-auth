<?php

namespace ITHilbert\UserAuth;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Config;
use Illuminate\View\Compilers\BladeCompiler;

class UserAuthServiceProvider extends ServiceProvider
{

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerConfig();
        $this->registerTranslations();
        $this->registerViews();
        $this->loadMigrationsFrom(__DIR__ . '/Database/Migrations');
        $this->registerRoutes();
        $this->publishAssets();
        $this->publishMenuFilters();
        $this->registerMiddleware();

        //Commands Registrieren
        $this->commands( \ITHilbert\UserAuth\App\Console\Commands\UserAuthCopyFiles::class );
    }

    public function publishMenuFilters(){
        $this->publishes([
            __DIR__ .'/App/Menu/Filters/' => app_path('Menu/Filters'),
        ]);
    }


    public function registerMiddleware(){
        $this->app['router']->aliasMiddleware('hasPermissionAnd' , \ITHilbert\UserAuth\Http\Middleware\hasPermissionAnd::class);
        $this->app['router']->aliasMiddleware('hasPermissionOr' , \ITHilbert\UserAuth\Http\Middleware\hasPermissionOr::class);
        $this->app['router']->aliasMiddleware('hasPermission', \ITHilbert\UserAuth\Http\Middleware\hasPermission::class);
        $this->app['router']->aliasMiddleware('hasRole', \ITHilbert\UserAuth\Http\Middleware\hasRole::class);
        $this->app['router']->aliasMiddleware('isAdmin', \ITHilbert\UserAuth\Http\Middleware\isAdmin::class);
        $this->app['router']->aliasMiddleware('isDev', \ITHilbert\UserAuth\Http\Middleware\isDev::class);
    }


    public function publishAssets()
    {
        $this->publishes([
            __DIR__ .'/Resources/assets' => public_path('vendor/userauth'),
        ]);
    }

    /**
     * Register Routes.
     *
     * @return void
     */
    protected function registerRoutes()
    {
        $this->loadRoutesFrom(__DIR__ . '/Routes/web.php');
    }


    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
       /*  $this->app->register(RouteServiceProvider::class); */
       $this->registerBladeExtensions();
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            __DIR__ .'/Config/config.php' => config_path('userauth.php'),
        ]);
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $this->publishes([
            __DIR__ .'/Resources/views' => resource_path('views/vendor/userauth'),
            __DIR__ .'/Resources/views/layouts/userauth.blade.php' => resource_path('views/layouts/userauth.blade.php'),
        ]);

        if(config('userauth.view') == 'ressources'){
            $this->loadViewsFrom(resource_path('Resources/views/vendor/userauth'), 'userauth');
        }else{
            $this->loadViewsFrom(__DIR__ .'/Resources/views', 'userauth');
        }
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $this->publishes([
            __DIR__.'/Resources/lang' => resource_path('lang/vendor/userauth'),
        ]);

        if(config('userauth.view') == 'ressources'){
            $this->loadTranslationsFrom( resource_path('/Resources/lang/vendor/userauth'), 'userauth');
        }else{
            $this->loadTranslationsFrom( __DIR__ .'/Resources/lang', 'userauth');
        }
    }


    /**
     * Eigende Blade function (Directive)
     *
     * @return void
     */
    protected function registerBladeExtensions()
    {
        $this->app->afterResolving('blade.compiler', function (BladeCompiler $bladeCompiler) {

            $bladeCompiler->directive('Role', function ($arguments) {
                list($role, $guard) = explode(',', $arguments.',');

                return "<?php if(auth({$guard})->check() && auth({$guard})->user()->hasRole({$role})): ?>";
            });
            $bladeCompiler->directive('elseRole', function ($arguments) {
                list($role, $guard) = explode(',', $arguments.',');

                return "<?php elseif(auth({$guard})->check() && auth({$guard})->user()->hasRole({$role})): ?>";
            });
            $bladeCompiler->directive('endRole', function () {
                return '<?php endif; ?>';
            });

            $bladeCompiler->directive('hasRole', function ($arguments) {
                list($role, $guard) = explode(',', $arguments.',');

                return "<?php if(auth({$guard})->check() && auth({$guard})->user()->hasRole({$role})): ?>";
            });
            $bladeCompiler->directive('endhasRole', function () {
                return '<?php endif; ?>';
            });

            $bladeCompiler->directive('hasanyrole', function ($arguments) {
                list($roles, $guard) = explode(',', $arguments.',');

                return "<?php if(auth({$guard})->check() && auth({$guard})->user()->hasAnyRole({$roles})): ?>";
            });
            $bladeCompiler->directive('endhasanyrole', function () {
                return '<?php endif; ?>';
            });

            $bladeCompiler->directive('hasallroles', function ($arguments) {
                list($roles, $guard) = explode(',', $arguments.',');

                return "<?php if(auth({$guard})->check() && auth({$guard})->user()->hasAllRoles({$roles})): ?>";
            });
            $bladeCompiler->directive('endhasallroles', function () {
                return '<?php endif; ?>';
            });

            $bladeCompiler->directive('unlessrole', function ($arguments) {
                list($role, $guard) = explode(',', $arguments.',');

                return "<?php if(!auth({$guard})->check() || ! auth({$guard})->user()->hasRole({$role})): ?>";
            });
            $bladeCompiler->directive('endunlessrole', function () {
                return '<?php endif; ?>';
            });

            $bladeCompiler->directive('hasPermission', function ($arguments) {
                list($permission, $guard) = explode(',', $arguments.',');

                return "<?php if(auth({$guard})->check() && auth({$guard})->user()->hasPermission({$permission})): ?>";
            });
            $bladeCompiler->directive('endhasPermission', function () {
                return '<?php endif; ?>';
            });


        });
    }
}
