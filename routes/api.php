<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MockProfileController;

Route::get('/profile/{uuid}', ProfileController::class);

Route::get('/mockProfile/source-one', [MockProfileController::class, 'sourceOne']);
Route::get('/mockProfile/source-two', [MockProfileController::class, 'sourceTwo']);
Route::get('/mockProfile/source-three', [MockProfileController::class, 'sourceThree']);
