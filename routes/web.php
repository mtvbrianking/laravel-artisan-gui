<?php

use Bmatovu\AristanGui\Http\CommandController;
use Illuminate\Support\Facades\Route;

Route::pattern('command', '^[a-z0-9\-\:]*$');

Route::get('/commands', [CommandController::class, '__invoke'])->name('commands');
Route::post('/commands/{command}', [CommandController::class, 'execute'])->name('commands.execute');
