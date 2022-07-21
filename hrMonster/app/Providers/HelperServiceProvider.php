<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App;

class HelperServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        App::bind('helper', function () {
            return new App\Services\Helper();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
