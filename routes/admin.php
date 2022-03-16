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

        Route::prefix('roles')
            ->group(function () {
                // show attendances time entries list
                Route::get('/')
                    ->name('admin.roles.index')
                    ->uses('RoleController@index');

                // show attendances time entry card
                Route::get('/view/{id}')
                    ->name('admin.roles.show')
                    ->uses('RoleController@show');

                // show create attendances time entry form
                Route::get('/create')
                    ->name('admin.roles.create')
                    ->uses('RoleController@create');

                // store attendances time entry
                Route::post('/store')
                    ->name('admin.roles.store')
                    ->uses('RoleController@store');

                // show edit attendances time entry form
                Route::get('/edit/{id}')
                    ->name('admin.roles.edit')
                    ->uses('RoleController@edit');

                // update an attendances time entry
                Route::patch('/edit/{id}')
                    ->name('admin.roles.update')
                    ->uses('RoleController@update');

                // remove an attendances time entry
                Route::delete('/edit/{id}')
                    ->name('admin.roles.destroy')
                    ->uses('RoleController@destroy');
            });

        Route::prefix('users')
            ->group(function () {
                // show attendances time entries list
                Route::get('/')
                    ->name('admin.users.index')
                    ->uses('UserController@index');

                // show attendances time entry card
                Route::get('/view/{id}')
                    ->name('admin.users.show')
                    ->uses('UserController@show');

                // show create attendances time entry form
                Route::get('/create')
                    ->name('admin.users.create')
                    ->uses('UserController@create');

                // store attendances time entry
                Route::post('/store')
                    ->name('admin.users.store')
                    ->uses('UserController@store');

                // show edit attendances time entry form
                Route::get('/edit/{id}')
                    ->name('admin.users.edit')
                    ->uses('UserController@edit');

                // update an attendances time entry
                Route::patch('/edit/{id}')
                    ->name('admin.users.update')
                    ->uses('UserController@update');

                // remove an attendances time entry
                Route::delete('/edit/{id}')
                    ->name('admin.users.destroy')
                    ->uses('UserController@destroy');
            });

        Route::prefix('attendances')
            ->group(function () {
                Route::prefix('types')
                    ->group(function () {
                        // show attendances time entry types list
                        Route::get('/')
                            ->name('admin.attendances.types.index')
                            ->uses('AttendanceTypeController@index');

                        // show attendances time entry type card
                        Route::get('/view/{id}')
                            ->name('admin.attendances.types.show')
                            ->uses('AttendanceTypeController@show');

                        // show create attendances time entry type form
                        Route::get('/create')
                            ->name('admin.attendances.types.create')
                            ->uses('AttendanceTypeController@create');

                        // store attendances time entry type
                        Route::post('/store')
                            ->name('admin.attendances.types.store')
                            ->uses('AttendanceTypeController@store');

                        // show edit attendances time entry type form
                        Route::get('/edit/{id}')
                            ->name('admin.attendances.types.edit')
                            ->uses('AttendanceTypeController@edit');

                        // update an attendances time entry type
                        Route::patch('/edit/{id}')
                            ->name('admin.attendances.types.update')
                            ->uses('AttendanceTypeController@update');

                        // remove an attendances time entry type
                        Route::delete('/edit/{id}')
                            ->name('admin.attendances.types.destroy')
                            ->uses('AttendanceTypeController@destroy');
                    });

                Route::prefix('entries')
                    ->group(function () {
                        // show attendances time entries list
                        Route::get('/')
                            ->name('admin.attendances.entries.index')
                            ->uses('AttendanceEntryController@index');

                        // show attendances time entry card
                        Route::get('/view/{id}')
                            ->name('admin.attendances.entries.show')
                            ->uses('AttendanceEntryController@show');

                        // show create attendances time entry form
                        Route::get('/create')
                            ->name('admin.attendances.entries.create')
                            ->uses('AttendanceEntryController@create');

                        // store attendances time entry
                        Route::post('/store')
                            ->name('admin.attendances.entries.store')
                            ->uses('AttendanceEntryController@store');

                        // show edit attendances time entry form
                        Route::get('/edit/{id}')
                            ->name('admin.attendances.entries.edit')
                            ->uses('AttendanceEntryController@edit');

                        // update an attendances time entry
                        Route::patch('/edit/{id}')
                            ->name('admin.attendances.entries.update')
                            ->uses('AttendanceEntryController@update');

                        // remove an attendances time entry
                        Route::delete('/edit/{id}')
                            ->name('admin.attendances.entries.destroy')
                            ->uses('AttendanceEntryController@destroy');
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
