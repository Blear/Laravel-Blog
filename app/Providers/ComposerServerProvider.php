<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ComposerServerProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        view()->composer('*','App\Http\ViewComposers\SettingComposer');
        view()->composer('themes.layouts.header', 'App\Http\ViewComposers\NavigationComposer');
        view()->composer('themes.widget.hot_article', 'App\Http\ViewComposers\HotArticleComposer');
        view()->composer('themes.widget.category', 'App\Http\ViewComposers\CategoryComposer');
        view()->composer('themes.widget.tag', 'App\Http\ViewComposers\TagComposer');
        view()->composer('themes.widget.link', 'App\Http\ViewComposers\LinkComposer');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
