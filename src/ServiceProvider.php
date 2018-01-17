<?php namespace Restlytics;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom($this->configPath(), 'restlytics');
    }

    /**
     * Add the Cors middleware to the router.
     */
    public function boot()
    {
        $this->publishes([$this->configPath() => config_path('restlytics.php')]);
    }

    protected function configPath()
    {
        return __DIR__ . '/../config/restlytics.php';
    }
}
