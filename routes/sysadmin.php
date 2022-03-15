<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Sysadmin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('sysadmin')
    ->middleware('auth')
    ->group(function () {

        Route::get('/clear-cache', function () {
            Artisan::call('cache:clear');
            Artisan::call('route:clear');
            Artisan::call('config:clear');
            Artisan::call('view:clear');
        
            return "App. is cleared";
        });
        
        Route::get('/list-route', function () {
            $routes = array_map(function (\Illuminate\Routing\Route $route) {
                return $route;
            }, (array) Route::getRoutes()->getIterator());
        
            return $routes;
        });
    });