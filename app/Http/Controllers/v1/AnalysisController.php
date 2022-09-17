<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Models\Analysis;
use Illuminate\Http\Request;

class AnalysisController extends Controller
{
    public function index()
    {
        return Analysis::all();
    }

    public function store(Request $request)
    {
        $analyses = Analysis::create($request->all());

        return $analyses;
    }

    public function show(Analysis $analyses)
    {
        return $analyses;
    }

    public function update(Request $request, int $id)
    {
        if ($request->restore) {
            $analyses = Analysis::withTrashed()->where('id', $id)->first();

            $analyses->restore();

            return $analyses;
        }

        $analyses = Analysis::find($id);

        $analyses->update($request->all());

        return $analyses;
    }

    public function destroy(Analysis $analyses)
    {
        $analyses->delete();

        return response(200);
    }
}
