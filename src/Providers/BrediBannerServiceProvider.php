<?php

namespace Brediweb\BrediBanner\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;

class BrediBannerServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

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
        $this->registerFactories();
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');

        $this->loadMenu();
    }

    public function loadMenu()
    {
        $this->app->booted(function() {
            
            if(config('bredibanner.autoload_menu')) {
                if (isset($this->app['config']['bredidashboard']['menu'])) {
                    $arr = $this->app['config']['bredidashboard']['menu'];
                    
                    $menu = [
                        [
                            'nome' => 'Banners',
                            'link' => route('bredibanner::controle.banner.index'),
                            'permissao' => 'controle.banner.index',
                            'activeMenu' => 'bredibanner::controle.banner'
                        ]
                    ];
                        
                    $this->app['config']->set('bredidashboard.menu', array_merge($arr, $menu));
                }
            }
        });
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            __DIR__.'/../Config/config.php' => config_path('bredibanner.php'),
        ], 'config');
        
        $this->publishes([
            __DIR__.'/../Config/config.php' => config_path('bredibanner.php'),
        ], 'banner-config');
        
        $this->mergeConfigFrom(
            __DIR__.'/../Config/config.php', 'bredibanner'
        );
    }

    /**
     * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/modules/bredibanner');

        $sourcePath = __DIR__.'/../Resources/views';

        $this->publishes([
            $sourcePath => $viewPath
        ],'views');
        
        $this->publishes([
            $sourcePath => $viewPath
        ],'bredi-banner');
        
        $this->publishes([
            $sourcePath => $viewPath
        ],'bredibanner');

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/modules/bredibanner';
        }, \Config::get('view.paths')), [$sourcePath]), 'bredibanner');
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/modules/bredibanner');

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, 'bredibanner');
        } else {
            $this->loadTranslationsFrom(__DIR__ .'/../Resources/lang', 'bredibanner');
        }
    }

    /**
     * Register an additional directory of factories.
     * 
     * @return void
     */
    public function registerFactories()
    {
        if (! app()->environment('production')) {
            app(Factory::class)->load(__DIR__ . '/../Database/factories');
        }
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
}
