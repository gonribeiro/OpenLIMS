<?php

use App\Http\Controllers\Api\V1\AnalysisApiController;
use App\Http\Controllers\Api\V1\CustodyApiController;
use App\Http\Controllers\Api\V1\IncidentApiController;
use App\Http\Controllers\Api\V1\ResultApiController;
use App\Http\Controllers\Api\V1\SampleApiController;
use App\Http\Controllers\Api\V1\StorageApiController;
use App\Http\Controllers\Api\V1\SubsampleController;
use App\Http\Controllers\Api\V1\TestApiController;
use App\Http\Controllers\Api\V1\UserApiController;
use App\Http\Controllers\Api\V1\Invokables\Enum;
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
        Route::get('enum/{name}', Enum::class);

        Route::apiResource('analysis', AnalysisApiController::class);
        Route::prefix('custody')->group(function () {
            Route::get('sampleType/{sample_type}/sampleId/{sample_id}', [CustodyApiController::class, 'findBySampleId'])->name('custody.findBySampleId');
            Route::post('{sampleIds}/store', [CustodyApiController::class, 'store'])->name('custody.store');
        });
        Route::apiResource('incident', IncidentApiController::class)->except('store');
        Route::post('incident/{sampleIds}/store', [IncidentApiController::class, 'store'])->name('incident.store');
        Route::prefix('result')->group(function () {
            Route::get('{testIds}/findResultsByTestIds', [ResultApiController::class, 'findResultsByTestIds'])->name('result.findResultsByTestIds');
            Route::post('storeOrUpdate', [ResultApiController::class, 'storeOrUpdate'])->name('result.storeOrUpdate');
        });
        Route::apiResource('sample', SampleApiController::class)->only('index', 'store', 'destroy');
        Route::prefix('sample')->group(function () {
            Route::get('findByIds/{ids}', [SampleApiController::class, 'findByIds'])->name('sample.findByIds');
            Route::patch('updateByIds', [SampleApiController::class, 'updateByIds'])->name('sample.updateByIds');
        });
        Route::apiResource('storage', StorageApiController::class);
        Route::apiResource('subsample', SubsampleController::class);
        Route::apiResource('test', TestApiController::class)->only('destroy');
        Route::prefix('test')->group(function () {
            Route::get('sampleType/{sample_type}/sampleId/{sample_id}', [TestApiController::class, 'findBySampleId'])->name('test.findBySampleId');
            Route::post('{sampleIds}/store', [TestApiController::class, 'store'])->name('test.store');
        });
        Route::apiResource('user', UserApiController::class);
    });
});

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
