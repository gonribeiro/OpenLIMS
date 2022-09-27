<?php

namespace App\Http\Controllers;

use App\Http\Requests\SampleRequest;
use App\Http\Services\SampleService;
use App\Models\Sample;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SampleController extends Controller
{
    public function index(): View
    {
        return view('sample.index');
    }

    public function quantityCreate(): View
    {
        return view('sample.sampleQuantityDialog');
    }

    public function create(Request $request): View
    {
        return view('sample.form')->with('quantity', $request->quantity);
    }

    public function store(SampleRequest $request): RedirectResponse
    {
        dd($request->all());
        $sample = SampleService::store($request);

        return redirect()->route('sample.edit', $sample)->with('message', 'Saved!');
    }

    public function edit(Sample $sample): View
    {
        return view('sample.form', compact('sample'));
    }

    public function update(SampleRequest $request, int $id): RedirectResponse
    {
        $sample = SampleService::update($request, $id);

        return redirect()->route('sample.edit', $sample)->with('message', 'Saved!');
    }
}
