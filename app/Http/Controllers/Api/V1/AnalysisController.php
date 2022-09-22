<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Analysis;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AnalysisController extends Controller
{
    public function index(): Response
    {
        return response(Analysis::all());
    }

    public function store(Request $request): Response
    {
        $analysis = Analysis::create($request->all());

        return response($analysis, 201);
    }

    public function show(Analysis $analysi): Response
    {
        return response($analysi);
    }

    public function update(Request $request, int $id): Response
    {
        if ($request->restore) {
            $analysis = Analysis::withTrashed()->where('id', $id)->first();

            $analysis->restore();
        } else {
            $analysis = Analysis::find($id);

            $analysis->update($request->all());
        }

        return response($analysis, 204);
    }

    public function destroy(Analysis $analysi): Response
    {
        $analysi->delete();

        return response('Successfully deleted', 204);
    }
}
