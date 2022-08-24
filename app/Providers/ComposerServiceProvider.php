<?php

namespace App\Providers;

use App\Http\ViewComposer\CategoryComposer;
use App\Http\ViewComposer\PostComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', CategoryComposer::class);
        View::composer('*', PostComposer::class);
    }
}
