<?php

namespace App\Providers;

use App\Models\Blog;
use Illuminate\Support\ServiceProvider;
use \Illuminate\Support\Facades\View;

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
        View::composer(['partials.meta_dynamic','layouts.nav'],function($view){
            $view->with('blogs',Blog::where('status',1)->latest()->get());
        });
    }
}
