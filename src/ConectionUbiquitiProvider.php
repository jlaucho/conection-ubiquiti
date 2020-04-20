<?php

namespace jlaucho\conection_ubiquiti;

use Illuminate\Support\ServiceProvider;

class ConectionUbiquitiProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/config/ConectionUbiquiti.php' => config_path('ConectionUbiquiti.php'),
            __DIR__ . '/UbiquitiModel.php' => base_path('app/UbiquitiModel.php')],
            'migrations');
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
