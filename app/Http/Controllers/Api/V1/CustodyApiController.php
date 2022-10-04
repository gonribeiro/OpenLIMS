<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustodyRequest;
use App\Http\Services\CustodyService;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class CustodyApiController extends Controller
{
    public function store(CustodyRequest $request, string $sampleIds): Response
    {
        try {
            CustodyService::store($request->all(), $sampleIds);
        } catch (\Throwable $th) {
            Log::error($th);

            return response($th, 409);
        }

        return response('Created!', 201);
    }

    public function findBySampleId(string $sampleType, int $sampleId): Response
    {
        $custodies = CustodyService::findBySampleId($sampleType, $sampleId);

        return response($custodies);
    }
}
