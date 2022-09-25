<?php

use App\Http\Controllers\SampleController;
use App\Http\Controllers\StorageController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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
    return view('users.index');
});

Route::resource('user', UserController::class)->except('show', 'destroy');
Route::resource('storage', StorageController::class)->except('show', 'destroy');
// Route::resource('sample', SampleController::class)->except('show');
