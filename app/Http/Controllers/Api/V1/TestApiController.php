<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Services\TestService;
use App\Models\Test;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class TestApiController extends Controller
{
    public static function store(Request $request, string $sampleIds): Response
    {
        try {
            TestService::store($request->all(), $sampleIds);
         } catch (\Throwable $th) {
            Log::error($th);
 
            return response($th, 409);
         }

        return response('Created!', 201);
    }

    public function findBySampleId(string $sampleType, int $sampleId): Response
    {
        $tests = TestService::findBySampleId($sampleType, $sampleId);

        return response($tests);
    }

    public function destroy(Test $test): Response
    {
        TestService::destroy($test);

        return response('Successfully deleted', 204);
    }
}
