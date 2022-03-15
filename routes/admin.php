<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('admin')
    ->middleware('auth')
    ->group(function () {

        Route::prefix('attendances')
            ->group(function () {
                Route::prefix('types')
                    ->group(function () {
                        // show attendances time entry types list
                        Route::get('/')
                            ->name('admin.attendances.types.index')
                            ->uses('TimeEntryTypeController@index');

                        // show attendances time entry type card
                        Route::get('/view/{id}')
                            ->name('admin.attendances.types.show')
                            ->uses('TimeEntryTypeController@show');

                        // show create attendances time entry type form
                        Route::get('/create')
                            ->name('admin.attendances.types.create')
                            ->uses('TimeEntryTypeController@create');

                        // store attendances time entry type
                        Route::post('/store')
                            ->name('admin.attendances.types.store')
                            ->uses('TimeEntryTypeController@store');

                        // show edit attendances time entry type form
                        Route::get('/edit/{id}')
                            ->name('admin.attendances.types.edit')
                            ->uses('TimeEntryTypeController@edit');

                        // update an attendances time entry type
                        Route::patch('/edit/{id}')
                            ->name('admin.attendances.types.update')
                            ->uses('TimeEntryTypeController@update');

                        // remove an attendances time entry type
                        Route::delete('/edit/{id}')
                            ->name('admin.attendances.types.destroy')
                            ->uses('TimeEntryTypeController@destroy');
                    });

                Route::prefix('entries')
                    ->group(function () {
                        // show attendances time entries list
                        Route::get('/')
                            ->name('admin.attendances.entries.index')
                            ->uses('TimeEntryController@index');

                        // show attendances time entry card
                        Route::get('/view/{id}')
                            ->name('admin.attendances.entries.show')
                            ->uses('TimeEntryController@show');

                        // show create attendances time entry form
                        Route::get('/create')
                            ->name('admin.attendances.entries.create')
                            ->uses('TimeEntryController@create');

                        // store attendances time entry
                        Route::post('/store')
                            ->name('admin.attendances.entries.store')
                            ->uses('TimeEntryController@store');

                        // show edit attendances time entry form
                        Route::get('/edit/{id}')
                            ->name('admin.attendances.entries.edit')
                            ->uses('TimeEntryController@edit');

                        // update an attendances time entry
                        Route::patch('/edit/{id}')
                            ->name('admin.attendances.entries.update')
                            ->uses('TimeEntryController@update');

                        // remove an attendances time entry
                        Route::delete('/edit/{id}')
                            ->name('admin.attendances.entries.destroy')
                            ->uses('TimeEntryController@destroy');
                    });
            });

        Route::prefix('children')
            ->group(function () {
                // show attendances time entries list
                Route::get('/')
                    ->name('admin.children.index')
                    ->uses('ChildController@index');

                // show attendances time entry card
                Route::get('/view/{id}')
                    ->name('admin.children.show')
                    ->uses('ChildController@show');

                // show create attendances time entry form
                Route::get('/create')
                    ->name('admin.children.create')
                    ->uses('ChildController@create');

                // store attendances time entry
                Route::post('/store')
                    ->name('admin.children.store')
                    ->uses('ChildController@store');

                // show edit attendances time entry form
                Route::get('/edit/{id}')
                    ->name('admin.children.edit')
                    ->uses('ChildController@edit');

                // update an attendances time entry
                Route::patch('/edit/{id}')
                    ->name('admin.children.update')
                    ->uses('ChildController@update');

                // remove an attendances time entry
                Route::delete('/edit/{id}')
                    ->name('admin.children.destroy')
                    ->uses('ChildController@destroy');
            });
    });
