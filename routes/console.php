<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    // Comando de ejemplo de Laravel para mostrar una frase en la terminal.
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');
