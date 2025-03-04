<?php

use App\Http\Controllers\ReciterController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::resource('/', ReciterController::class);

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('dashboard');
    })->name('dashboard');
});

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
