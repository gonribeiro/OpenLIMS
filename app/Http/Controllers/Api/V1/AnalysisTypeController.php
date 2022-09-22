<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\AnalysisType;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AnalysisTypeController extends Controller
{
    public function index(): Response
    {
        return response(AnalysisType::all());
    }

    public function store(Request $request): Response
    {
        $analysis = AnalysisType::create($request->all());

        return response($analysis, 201);
    }

    public function show(AnalysisType $analysisType): Response
    {
        return response($analysisType);
    }

    public function update(Request $request, int $id): Response
    {
        if ($request->restore) {
            $analysis = AnalysisType::withTrashed()->where('id', $id)->first();

            $analysis->restore();
        } else {
            $analysis = AnalysisType::find($id);

            $analysis->update($request->all());
        }

        return response($analysis, 204);
    }

    public function destroy(AnalysisType $analysisType): Response
    {
        $analysisType->delete();

        return response('Successfully deleted', 204);
    }
}
