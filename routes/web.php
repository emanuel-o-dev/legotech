<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::fallback(function () {
    return response()->view('errors.generic', [
        'code' => 404,
        'message' => 'A página que você procura não existe.'
    ], 404);
});
