<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResultRequest;
use App\Http\Services\ResultService;
use App\Http\Services\SampleService;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class ResultController extends Controller
{
    public function findResultsBySampleIds(string $sampleIds): View
    {
        $samplesWithTests = SampleService::findByIdsWhereHasTests($sampleIds);

        $samplesWithoutTests = SampleService::findByIdsWhereDoesntHaveTests($sampleIds);

        return view('result.form', compact('samplesWithTests', 'samplesWithoutTests'));
    }

    public function storeOrUpdate(ResultRequest $request)
    {
        try {
            ResultService::storeOrUpdate($request);
        } catch (\Throwable $th) {
            Log::error($th);

            return redirect()->back()->withErrors("Error while attempting update or storage the results.");
        }

        return redirect()->back()->with('message', 'Saved!');
    }
}
