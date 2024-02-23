<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Faker\Factory as FakerFactory;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */

    public function register()
    {
        $this->app->singleton('Faker\Generator', function () {
            return FakerFactory::create('id_ID'); // Ganti 'id_ID' dengan kode bahasa yang diinginkan
        });
    }
}
