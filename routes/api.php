<?php

use App\Http\Controllers\Api\V1\AnalysisController;
use App\Http\Controllers\Api\V1\AnalysisTypeController;
use App\Http\Controllers\Api\V1\IncidentController;
use App\Http\Controllers\Api\V1\OrderController;
use App\Http\Controllers\Api\V1\OrderTypeController;
use App\Http\Controllers\Api\V1\SampleController;
use App\Http\Controllers\Api\V1\StorageController;
use App\Http\Controllers\Api\V1\SubsampleController;
use App\Http\Controllers\Api\V1\TestController;
use App\Http\Controllers\Api\V1\UserController;
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
    Route::resource('sample', SampleController::class)->only('index', 'store', 'destroy');
    Route::get('sample/findByIds/{ids}', [SampleController::class, 'findByIds']);
    Route::patch('sample/updateByIds', [SampleController::class, 'updateByIds']);
    Route::resource('orderType', OrderTypeController::class)->except('create', 'edit');
    Route::resource('order', OrderController::class)->except('create', 'edit');
    Route::resource('subsample', SubsampleController::class)->except('create', 'edit');
    Route::resource('analysisType', AnalysisTypeController::class)->except('create', 'edit');
    Route::resource('analysis', AnalysisController::class)->except('create', 'edit');
    Route::resource('test', TestController::class)->only('update', 'destroy', 'index');
    Route::resource('incident', IncidentController::class)->except('create', 'edit');
    Route::resource('storage', StorageController::class)->except('create', 'edit');
});

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
