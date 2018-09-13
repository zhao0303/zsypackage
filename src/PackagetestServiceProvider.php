<?php
namespace Zsy\Packagetest;

use function foo\func;
use Illuminate\Support\ServiceProvider;

class PackagetestServiceProvider extends ServiceProvider
{
    protected $defer = true;
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/views', 'Packagetest');
        $this->publishes([
            __DIR__.'/views' => base_path('resources/views/vendor/packagetest'),
            __DIR__.'/config/packagetest.php' => config_path('packagetest.php'),
        ]);
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('packagetest', function ($app) {
            return new Packagetest($app['session'], $app['config']);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['packagetest'];
    }
}
