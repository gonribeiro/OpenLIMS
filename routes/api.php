<?php

use App\Http\Controllers\Api\V1\AnalysisController;
use App\Http\Controllers\Api\V1\AnalysisTypeController;
use App\Http\Controllers\Api\V1\CustodyController;
use App\Http\Controllers\Api\V1\IncidentController;
use App\Http\Controllers\Api\V1\OrderController;
use App\Http\Controllers\Api\V1\OrderTypeController;
use App\Http\Controllers\Api\V1\ResultController;
use App\Http\Controllers\Api\V1\SampleController;
use App\Http\Controllers\Api\V1\StorageApiController;
use App\Http\Controllers\Api\V1\SubsampleController;
use App\Http\Controllers\Api\V1\TestController;
use App\Http\Controllers\Api\V1\UserApiController;
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
    Route::name('api.')->group(function () {
        Route::apiResource('analysis', AnalysisController::class);
        Route::apiResource('analysisType', AnalysisTypeController::class);
        Route::prefix('custody')->group(function () {
            Route::get('bySample/sampleType/{sample_type}/sampleId/{sample_id}', [CustodyController::class, 'custodiesBySample']);
            Route::post('storeSample', [CustodyController::class, 'storeSample']);
            Route::post('storeSubsample', [CustodyController::class, 'storeSubsample']);
        });
        Route::apiResource('incident', IncidentController::class);
        Route::apiResource('order', OrderController::class);
        Route::apiResource('orderType', OrderTypeController::class);
        Route::apiResource('result', ResultController::class);
        Route::apiResource('sample', SampleController::class)->only('index', 'store', 'destroy');
        Route::get('sample/findByIds/{ids}', [SampleController::class, 'findByIds']);
        Route::patch('sample/updateByIds', [SampleController::class, 'updateByIds']);
        Route::apiResource('storage', StorageApiController::class);
        Route::apiResource('subsample', SubsampleController::class);
        Route::apiResource('test', TestController::class)->only('index', 'update', 'destroy');
        Route::apiResource('user', UserApiController::class);
    });
});

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
