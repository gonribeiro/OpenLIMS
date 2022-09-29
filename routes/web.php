<?php

use App\Http\Controllers\AnalysisController;
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
    return view('user.index');
});

Route::resource('analysis', AnalysisController::class)->except('show', 'destroy');
Route::resource('storage', StorageController::class)->except('show', 'destroy');
Route::resource('user', UserController::class)->except('show', 'destroy');
Route::resource('sample', SampleController::class)->only('index', 'store', 'update');
Route::prefix('sample')->group(function () {
    Route::get('sampleQuantityDialog', [SampleController::class, 'sampleQuantityDialog'])->name('sample.sampleQuantityDialog');
    Route::post('create', [SampleController::class, 'create'])->name('sample.create');
    Route::get('{ids}/edit', [SampleController::class, 'edit'])->name('sample.edit');
    Route::get('update', [SampleController::class, 'update'])->name('sample.update');
});

