<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ChildController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/dashboard');;
});

Route::get('/credits', function () {
    return view('credits');;
});

Route::get('/dashboard', [PageController::class, 'dashboard'])->middleware(['auth'])->name('dashboard');

require __DIR__ . '/admin.php';
require __DIR__ . '/sysadmin.php';
require __DIR__ . '/user.php';

require __DIR__ . '/auth.php';
