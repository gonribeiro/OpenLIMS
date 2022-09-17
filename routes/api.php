<?php

use App\Http\Controllers\v1\AnalysisController;
use App\Http\Controllers\v1\SampleController;
use App\Http\Controllers\v1\SampleTypeController;
use App\Http\Controllers\v1\TestController;
use App\Http\Controllers\v1\UserController;
use App\Models\Analysis;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('v1')->group(function () {
    Route::resource('user', UserController::class)->except('create', 'edit');
    Route::resource('sampleType', SampleTypeController::class)->except('create', 'edit');
    Route::resource('sample', SampleController::class)->except('create', 'edit');
    Route::resource('analysis', AnalysisController::class)->except('create', 'edit');
    Route::resource('test', TestController::class)->except('create', 'edit');
});

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
