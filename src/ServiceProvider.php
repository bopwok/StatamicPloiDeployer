<?php

namespace Savelend\PloiDeployer;

use Statamic\Providers\AddonServiceProvider;
use Savelend\PloiDeployer\Widgets\PloiDeployer;
use Savelend\PloiDeployer\Config\PloiConfig;

class ServiceProvider extends AddonServiceProvider
{
    protected $widgets = [
        PloiDeployer::class
    ];

    protected $routes = [
        'cp' => __DIR__.'/../routes/cp.php',
    ];

    protected $vite = [
        'input' => [
            'resources/js/cp.js',
        ],
        'publicDirectory' => 'resources/dist',
    ];

    public function bootAddon()
    {
        // Register config
        $this->app->singleton('ploi-config', function ($app) {
            return new PloiConfig();
        });
        
        // Load views
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'savelend.ploi-deployer');
        
        // Register nav item
        \Statamic\Facades\CP\Nav::extend(function ($nav) {
            $nav->tools('Ploi Deployer')
                ->route('ploi-deployer.config.index')
                ->icon('hammer-wrench');
        });
    }
}