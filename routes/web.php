<?php

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Route;

Route::get('/', function (): View {
    // El puerto 8000 muestra la experiencia SysType de práctica y progreso.
    return view('systype');
});
