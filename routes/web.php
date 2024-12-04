<?php

use App\Http\Controllers\AccessLinkController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\RegistrationController;
use App\Http\Middleware\EnsureTokenIsValid;
use Illuminate\Support\Facades\Route;

Route::get('/', [RegistrationController::class, 'showRegistrationForm'])
    ->name('showRegistrationForm');;
Route::post('/register', [RegistrationController::class, 'register'])
    ->name('register');

Route::get('/gamePage/{token}', [GameController::class, 'index'])
    ->name('gamePage');

Route::post('link/deactivate', [AccessLinkController::class, 'deactivate'])
    ->name('deactivateLink')->middleware(EnsureTokenIsValid::class);

Route::post('link/regenerate', [AccessLinkController::class, 'regenerate'])
    ->name('regenerateLink')->middleware(EnsureTokenIsValid::class);

Route::post('game', [GameController::class, 'play'])
    ->name('playGame')->middleware(EnsureTokenIsValid::class);

Route::get('game', [GameController::class, 'history'])
    ->name('gameHistory')->middleware(EnsureTokenIsValid::class);

Route::get('/test', function () {
    return view('welcome');
});



