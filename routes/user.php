<?php

use App\Http\Controllers\ChildController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| User Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('my')
    ->middleware('auth')
    ->group(function () {
        Route::get('/children', [ChildController::class, 'my'])->name('my.children');
        Route::get('/profile', [UserController::class, 'my'])->name('my.profile');
    });
