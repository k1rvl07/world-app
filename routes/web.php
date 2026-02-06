<?php

use App\Http\Controllers\CountryController;
use Illuminate\Support\Facades\Route;

Route::get('/world', [CountryController::class, 'index'])->name('world.index');
Route::get('/world/{code}', [CountryController::class, 'show'])->name('world.show');
Route::get('/world/{code}/cities', [CountryController::class, 'cities'])->name('world.cities');
