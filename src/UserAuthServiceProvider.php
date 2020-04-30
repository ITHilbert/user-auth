<?php

namespace ITHilbert\UserAuth;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;

class UserAuthServiceProvider extends ServiceProvider
{
    /**
     * @var string $moduleName
     */
    protected $moduleName = 'UserAuth';

    /**
     * @var string $moduleNameLower
     */
    protected $moduleNameLower = 'userauth';

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        /* $this->registerFactories(); */
        $this->loadMigrationsFrom(__DIR__ . '/Database/Migrations');

        /* $this->registerCommands();  */
        $this->registerRoutes();
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
     * Register commands.
     *
     * @return void
     */
    protected function registerCommands()
    {
        /* $this->commands(\Modules\Userauth\Console\PublishCommand::class); */
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
       /*  $this->app->register(RouteServiceProvider::class); */
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
        ]); //, 'config');

        /* $this->mergeConfigFrom(
            module_path($this->moduleName, 'Config/config.php'), $this->moduleNameLower
        ); */
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $this->publishes([
            __DIR__ .'/Resources/views' => resource_path('views/vendor/userauth')
        ]);

        $this->loadViewsFrom(__DIR__ .'/Resources/views', 'userauth');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $this->loadTranslationsFrom(__DIR__.'/Resources/lang', 'userauth');

        $this->publishes([
            __DIR__.'/Resources/lang' => resource_path('lang/vendor/userauth'),
        ]);
    }

    /**
     * Register an additional directory of factories.
     *
     * @return void
     */
    public function registerFactories()
    {
        /* if (! app()->environment('production') && $this->app->runningInConsole()) {
            app(Factory::class)->load(module_path($this->moduleName, 'Database/factories'));
        } */
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }

    private function getPublishableViewPaths() //: array
    {

        /* $paths = [];
        foreach (\Config::get('view.paths') as $path) {
            if (is_dir($path . '/modules/' . $this->moduleNameLower)) {
                $paths[] = $path . '/modules/' . $this->moduleNameLower;
            }
        }
        return $paths; */
    }
}
