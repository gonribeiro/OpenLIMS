<?php

namespace App\Http\Services;

use App\Models\Analysis;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class AnalysisService
{
    public static function index(): Collection
    {
        return Analysis::orderBy('id', 'desc')->get();
    }

    public static function store(Request $request): Analysis
    {
        return Analysis::create($request->all());
    }

    public static function update(Request $request, int $id): Analysis
    {
        if ($request->restore) {
            $analysis = Analysis::withTrashed()->where('id', $id)->first();

            $analysis->restore();
        } else {
            $analysis = Analysis::find($id);

            $analysis->update($request->all());
        }

        return $analysis;
    }

    public static function destroy(Analysis $analysis): void
    {
        $analysis->delete();
    }
}
