<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Models\Sample;
use App\Models\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SampleController extends Controller
{
    public function index()
    {
        return Sample::all();
    }

    public function store(Request $request)
    {
        $sample = ''; // returns created sample
        try {
            DB::transaction(function () use ($request, &$sample) {
                $sample = Sample::create($request->all());

                if ($request->tests) {
                    foreach ($request->tests as $test) {
                        $newTest = new Test($test);

                        $newTest->sample()->associate($sample);

                        $newTest->save();
                    }
                }
            });
        } catch (\Throwable $th) {
            return response(409);
        }

        return $sample;
    }

    public function show(Sample $sample)
    {
        return $sample;
    }

    public function update(Request $request, int $id)
    {
        if ($request->restore) {
            $sample = Sample::withTrashed()->where('id', $id)->first();

            $sample->restore();

            return $sample;
        }

        $sample = Sample::find($id);

        $sample->update($request->all());

        return $sample;
    }

    public function destroy(Sample $sample)
    {
        $sample->delete();

        return response(200);
    }
}
