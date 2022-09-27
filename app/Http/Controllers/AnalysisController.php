<?php

namespace App\Http\Controllers;

use App\Http\Requests\AnalysisRequest;
use App\Http\Services\AnalysisService;
use App\Models\Analysis;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AnalysisController extends Controller
{
    public function index(): View
    {
        return view('analysis.index');
    }

    public function create(): View
    {
        return view('analysis.form');
    }

    public function store(AnalysisRequest $request): RedirectResponse
    {
        $analysis = AnalysisService::store($request);

        return redirect()->route('analysis.edit', $analysis)->with('message', 'Saved!');
    }

    public function edit(Analysis $analysi): View
    {
        return view('analysis.form', compact('analysi'));
    }

    public function update(AnalysisRequest $request, int $id): RedirectResponse
    {
        $analysis = AnalysisService::update($request, $id);

        return redirect()->route('analysis.edit', $analysis)->with('message', 'Saved!');
    }
}
