<?php

use App\Filament\Pages\Homepage;
use App\Service\AuthLogin;
use Illuminate\Support\Facades\Route;

Route::get('/', Homepage::class);
AuthLogin::routes();

/*
Route::get('/', function () {
    return view('filament.front-panel.pages.home');
});*/
