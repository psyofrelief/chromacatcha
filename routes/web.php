<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\ConvertController;

Route::get('/', function () {
    return view('home');
});

Route::post('/colors', [ColorController::class, 'extractColors']);
Route::post('/colors/hex', [ConvertController::class, 'convertColors']);
Route::post('/colors/rgba', [ConvertController::class, 'convertColors']);

