<?php namespace Sukohi\ShowColumn;

use Illuminate\Support\ServiceProvider;

class ShowColumnServiceProvider extends ServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var  bool
     */
    protected $defer = true;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton('command.code:db', function ($app) {

            return $app['Sukohi\ShowColumn\Commands\ShowColumnCommand'];

        });
        $this->commands('command.code:db');
        $this->loadViewsFrom(__DIR__.'/views', 'show-column');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['show-column'];
    }

}