<?php

use App\Filament\Pages\Homepage;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', Homepage::class);

Route::redirect('/login', '/front/login')->name('login');

Route::get('/protected-route', [AuthController::class, 'login'])
    ->name('protected.route');

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
