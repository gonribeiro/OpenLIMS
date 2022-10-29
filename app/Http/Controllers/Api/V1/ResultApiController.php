<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResultRequest;
use App\Http\Services\ResultService;
use App\Http\Services\TestService;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class ResultApiController extends Controller
{
    public function findResultsByTestIds(string $testIds): Response
    {
        return response(TestService::findByIds($testIds));
    }

    public function storeOrUpdate(ResultRequest $request)
    {
        try {
            ResultService::storeOrUpdate($request);
        } catch (\Throwable $th) {
            Log::error($th);

            return response($th, 409);
        }

        return response('Saved!', 204);
    }
}
