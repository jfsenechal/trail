<?php

use App\Filament\Pages\Homepage;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', Homepage::class);

Route::redirect('/login', '/front/login')->name('login');

Route::get('/protected-route', [AuthController::class, 'login'])
    ->name('protected.route');

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
