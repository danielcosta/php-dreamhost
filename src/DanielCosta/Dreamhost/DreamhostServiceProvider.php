<?php namespace DanielCosta\Dreamhost;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use \Config;

/**
 * Class DreamhostServiceProvider
 *
 * @package DanielCosta\Dreamhost
 * @author  Daniel Costa <danielcosta@gmail.com>
 * @version 2.0.0
 */
class DreamhostServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->package('danielcosta/php-dreamhost');

        // Auto create app alias with boot method
        // No need to alias in app/config/app.php
        $loader = AliasLoader::getInstance();
        $loader->alias('Dreamhost', 'DanielCosta\Dreamhost\Facades\Dreamhost');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
	{
        $this->app['dreamhost'] = $this->app->share(function($app)
        {
            // Setup Dreamhost instance and config options
            $dh = new Dreamhost();

            $dh->key     = Config::get('php-dreamhost::key');
            $dh->api_url = Config::get('php-dreamhost::api_url');
            $dh->format  = Config::get('php-dreamhost::format');

            return $dh;
        });
	}

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array('dreamhost');
    }

}
