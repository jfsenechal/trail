<?php

use App\Filament\Pages\Homepage;
use Illuminate\Support\Facades\Route;

Route::get('/', Homepage::class);

/*
Route::get('/', function () {
    return view('filament.front-panel.pages.home');
});*/
