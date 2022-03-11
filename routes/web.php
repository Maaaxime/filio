<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ChildrenController;
use App\Http\Controllers\UserController;

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

Route::group(['middleware' => ['auth', 'role:Admin'], 'prefix' => 'admin'], function () {
    Route::resource('roles', 'RoleController');
    Route::resource('users', 'UserController');
    Route::resource('childs', 'ChildrenController');
    Route::resource('companies', 'CompanyController');
});

Route::group(['middleware' => ['auth'], 'prefix' => 'my'], function () {
    Route::get('childs',[ChildrenController::class, 'my'])->name('my.childs');
    Route::get('profile',[UserController::class,'my'])->name('my.profile');
});

require __DIR__ . '/auth.php';
