<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Aquí se enlazan servicios propios con el contenedor de Laravel si se necesitan.
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Aquí se ejecuta configuración global cuando Laravel inicia la aplicación.
        //
    }
}
