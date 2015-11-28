<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * MediaWiki service provider
 */
class MediaWikiServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\MediaWiki\Contracts\MediaWiki', 'App\MediaWiki\Services\MediaWikiService');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['App\MediaWiki\Contracts\MediaWiki'];
    }
}
