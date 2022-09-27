<?php

namespace App\Http\Services;

use App\Models\Sample;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class SampleService
{
    public static function index(): Collection
    {
        return Sample::orderBy('id', 'desc')->get();
    }

    public static function store(Request $request): Sample
    {
        return Sample::create($request->all());
    }

    public static function update(Request $request, int $id): Sample
    {
        if ($request->restore) {
            $sample = Sample::withTrashed()->where('id', $id)->first();

            $sample->restore();
        } else {
            $sample = Sample::find($id);

            $sample->update($request->all());
        }

        return $sample;
    }

    public static function destroy(Sample $sample): void
    {
        $sample->delete();
    }
}
