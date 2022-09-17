<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Models\SampleType;
use Illuminate\Http\Request;

class SampleTypeController extends Controller
{
    public function index()
    {
        return SampleType::all();
    }

    public function store(Request $request)
    {
        $sampleType = SampleType::create($request->all());

        return $sampleType;
    }

    public function show(SampleType $sampleType)
    {
        return $sampleType;
    }

    public function update(Request $request, int $id)
    {
        if ($request->restore) {
            $sampleType = SampleType::withTrashed()->where('id', $id)->first();

            $sampleType->restore();

            return $sampleType;
        }

        $sampleType = SampleType::find($id);

        $sampleType->update($request->all());

        return $sampleType;
    }

    public function destroy(SampleType $sampleType)
    {
        $sampleType->delete();

        return response(200);
    }
}
