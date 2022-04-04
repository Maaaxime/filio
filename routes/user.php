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
                Route::post('/update-current')
                    ->name('user.attendances.updateCurrent')
                    ->uses('AttendanceEntryController@updateCurrent');

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

                // show attendances time entry card
                Route::get('/view/{child}')
                    ->name('user.children.show')
                    ->uses('ChildController@show');

                // show create attendances time entry form
                Route::get('/create')
                    ->name('user.children.create')
                    ->uses('ChildController@create');

                // store attendances time entry
                Route::post('/store')
                    ->name('user.children.store')
                    ->uses('ChildController@store');

                // show edit attendances time entry form
                Route::get('/edit/{child}')
                    ->name('user.children.edit')
                    ->uses('ChildController@edit');

                // update an attendances time entry
                Route::patch('/edit/{child}')
                    ->name('user.children.update')
                    ->uses('ChildController@update');

                // remove an attendances time entry
                Route::delete('/edit/{child}')
                    ->name('user.children.destroy')
                    ->uses('ChildController@destroy');
            });

        Route::prefix('profile')
            ->group(function () {

                Route::get('/')
                    ->name('user.profile.my')
                    ->uses('UserController@my');
            });
    });

Route::prefix('posts')
    ->group(function () {
        Route::get('/')
            ->name('user.posts.index')
            ->uses('PostController@index');

        Route::get('/view/{slug}')
            ->name('user.posts.show')
            ->uses('PostController@show');
    });
