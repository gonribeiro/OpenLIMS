<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustodyRequest;
use App\Http\Services\CustodyService;
use App\Http\Services\SampleService;
use App\Models\Sample;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class CustodyController extends Controller
{
    public function create(string $sampleIds): View
    {
        $samples = SampleService::findByIds($sampleIds);

        return view('custody.create', compact('samples'));
    }

    public function store(CustodyRequest $request, string $sampleIds): RedirectResponse
    {
        try {
            CustodyService::store($request->all(), $sampleIds);
        } catch (\Throwable $th) {
            Log::error($th);

            abort('403', 'Error!');
        }

        if (count(explode(',', $sampleIds)) == 1) {
            return redirect()->route('custody.edit', $sampleIds)->with('message', 'Saved!');
        }

        return redirect()->route('sample.index')->with('message', 'Saved!');
    }

    public function edit(Sample $sample): View
    {
        return view('custody.edit', compact('sample'));
    }
}
