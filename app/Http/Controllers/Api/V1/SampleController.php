<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Sample;
use App\Models\Test;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class SampleController extends Controller
{
    public function index(): Response
    {
        return response(Sample::orderBy('id', 'desc')->get());
    }

    public function store(Request $request): Response
    {
        try {
            DB::transaction(function () use ($request) {
                foreach ($request->samples as $sample) {
                    $newSample = Sample::create($sample);

                    if (isset($sample['tests'])) {
                        foreach ($sample['tests'] as $test) {
                            $newTest = new Test($test);

                            $newTest->sample()->associate($newSample);

                            $newTest->save();
                        }
                    }
                }
            });
        } catch (\Throwable $th) {
            return response($th, 409);
        }

        return response(201);
    }

    public function findByIds(string $ids): Response
    {
        $samples = Sample::whereIn('id', explode(',', $ids))->get();

        return response($samples);
    }

    public function updateByIds(Request $request): Response
    {
        try {
            DB::transaction(function () use ($request) {
                foreach ($request->samples as $sample) {

                    if (isset($sample['restore'])) {
                        $updateSample = Sample::withTrashed()->where('id', $sample['id'])->first();

                        $updateSample->restore();
                    } else {
                        $updateSample = Sample::find($sample['id']);

                        $updateSample->update($sample);
                    }
                }
            });
        } catch (\Throwable $th) {
            return response($th, 409);
        }

        return response('Successfully created', 204);
    }

    public function destroy(Sample $sample): Response
    {
        $sample->delete();

        return response('Successfully deleted', 204);
    }
}
