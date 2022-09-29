<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Services\SampleService;
use App\Models\Sample;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class SampleApiController extends Controller
{
    public function index(): Response
    {
        return response(SampleService::index());
    }

    public function store(Request $request): Response
    {
        try {
            SampleService::store($request);
        } catch (\Throwable $th) {
            Log::error($th);

            return response($th, 409);
        }

        return response(201);
    }

    public function findByIds(string $ids): Response
    {
        $samples = SampleService::findByIds($ids);

        return response($samples);
    }

    public function updateByIds(Request $request): Response
    {
        try {
            SampleService::updateByIds($request);
        } catch (\Throwable $th) {
            Log::error($th);

            return response($th, 409);
        }

        return response('Successfully created', 204);
    }

    public function destroy(Sample $sample): Response
    {
        SampleService::destroy($sample);

        return response('Successfully deleted', 204);
    }
}
