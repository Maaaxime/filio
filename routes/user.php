<?php

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

        Route::prefix('attendances')
            ->group(function () {

                Route::get('/check-in/{id?}')
                    ->name('user.attendances.checkin')
                    ->uses('AttendanceEntryController@checkIn');

                Route::post('/check-in')
                    ->name('user.attendances.checkin.store')
                    ->uses('AttendanceEntryController@storeCheckIn');

                Route::get('/check-out/{id}')
                    ->name('user.attendances.checkout')
                    ->uses('AttendanceEntryController@checkout');

                Route::patch('/check-out/{id}')
                    ->name('user.attendances.checkout.store')
                    ->uses('AttendanceEntryController@storeCheckout');
            });

        Route::prefix('children')
            ->group(function () {

                Route::get('/')
                    ->name('user.children.my')
                    ->uses('ChildController@my');
            });

        Route::prefix('profile')
            ->group(function () {

                Route::get('/')
                    ->name('user.profile.my')
                    ->uses('UserController@my');
            });
    });
