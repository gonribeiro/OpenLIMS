<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Services\AnalysisService;
use App\Models\Analysis;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AnalysisApiController extends Controller
{
    public function index(): Response
    {
        return response(AnalysisService::index());
    }

    public function store(Request $request): Response
    {
        $analysis = AnalysisService::store($request);

        return response($analysis, 201);
    }

    public function show(Analysis $analysi): Response
    {
        return response($analysi);
    }

    public function update(Request $request, int $id): Response
    {
        $analysis = AnalysisService::update($request, $id);

        return response($analysis, 204);
    }

    public function destroy(Analysis $analysi): Response
    {
        AnalysisService::destroy($analysi);

        return response('Successfully deleted', 204);
    }
}
