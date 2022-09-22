<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Subsample;
use App\Models\Test;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class SubsampleController extends Controller
{
    public function index(): Response
    {
        return response(Subsample::orderBy('id', 'desc')->get());
    }

    public function store(Request $request): Response
    {
        try {
            DB::transaction(function () use ($request) {
                foreach ($request->subsamples as $subsample) {
                    $newSubsample = Subsample::create($subsample);

                    if (isset($subsample['tests'])) {
                        foreach ($subsample['tests'] as $test) {
                            $newTest = new Test($test);

                            $newTest->sample()->associate($newSubsample);

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

    public function show(Subsample $subsample): Response
    {
        return response($subsample);
    }

    public function update(Request $request, int $id): Response
    {
        if ($request->restore) {
            $subsample = Subsample::withTrashed()->where('id', $id)->first();

            $subsample->restore();
        } else {
            $subsample = Subsample::find($id);

            $subsample->update($request->all());
        }

        return response($subsample, 204);
    }

    public function destroy(Subsample $subsample): Response
    {
        $subsample->delete();

        return response('Successfully deleted', 204);
    }
}
