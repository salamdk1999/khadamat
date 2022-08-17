<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ComposerServiceProvider extends ServiceProvider
{
    public function boot(){

        View::composer('include.header', 'App\Http\ViewComposers\headerComposer');
    }

    public function register()
    {
        $this->app->singleton(\App\Http\ViewComposers\headerComposer::class);
    }
}
