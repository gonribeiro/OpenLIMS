<?php

use App\Http\Controllers\AnalysisController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\CustodyController;
use App\Http\Controllers\IncidentController;
use App\Http\Controllers\ResultController;
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
Route::get('custody/{sampleIds}/create', [CustodyController::class, 'create'])->name('custody.create');
Route::post('custody/{sampleIds}/store', [CustodyController::class, 'store'])->name('custody.store');
Route::get('custody/{sample}/edit', [CustodyController::class, 'edit'])->name('custody.edit');
Route::resource('incident', IncidentController::class)->only('index', 'edit', 'update');
Route::get('incident/{sampleIds}/create', [IncidentController::class, 'create'])->name('incident.create');
Route::post('incident/{sampleIds}/store', [IncidentController::class, 'store'])->name('incident.store');
// Route::resource('result', ResultController::class)->only('index', 'store');
Route::resource('storage', StorageController::class)->except('show', 'destroy');
Route::resource('user', UserController::class)->except('show', 'destroy');
Route::resource('sample', SampleController::class)->only('index', 'store');
Route::prefix('sample')->group(function () {
    Route::get('quantityCreateDialog', [SampleController::class, 'quantityCreateDialog'])->name('sample.quantityCreateDialog');
    Route::get('create', [SampleController::class, 'create'])->name('sample.create');
    Route::get('{ids}/edit', [SampleController::class, 'edit'])->name('sample.edit');
    Route::patch('updateByIds', [SampleController::class, 'updateByIds'])->name('sample.updateByIds');
});
Route::post('test/{sampleIds}/store', [TestController::class, 'store'])->name('test.store');
Route::get('test/{sample}/edit', [TestController::class, 'edit'])->name('test.edit');
