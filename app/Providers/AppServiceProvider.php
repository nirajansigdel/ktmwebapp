<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use App\View\Composers\FrontendComposer;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $locale = Session::get('locale', 'en');
        App::setLocale($locale);

        // Register a separate namespace for the website views stored in resources/views2
        // Usage: view('site::frontend.home')
        View::addNamespace('site', resource_path('views2'));

        // Share frontend variables globally with all frontend views
        View::composer(['frontend.*', 'frontend.layouts.*', 'frontend.includes.*'], FrontendComposer::class);
    }
}
