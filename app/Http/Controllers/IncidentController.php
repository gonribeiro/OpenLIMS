<?php

namespace App\Http\Controllers;

use App\Http\Requests\IncidentRequest;
use App\Http\Services\IncidentService;
use App\Http\Services\SampleService;
use App\Models\Incident;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class IncidentController extends Controller
{
    public function index(): View
    {
        return view('incident.index');
    }

    public function create(string $sampleIds): View
    {
        $samples = SampleService::findByIds($sampleIds);

        return view('incident.form', compact('samples'));
    }

    public function store(IncidentRequest $request, string $sampleIds): RedirectResponse
    {
        try {
            IncidentService::store($request->all(), $sampleIds);
        } catch (\Throwable $th) {
            Log::error($th);

            abort('403', 'Error!');
        }

        return redirect()->route('incident.index')->with('message', 'Saved!');
    }

    public function edit(Incident $incident): View
    {
        return view('incident.form', compact('incident'));
    }

    public function update(IncidentRequest $request, int $id): RedirectResponse
    {
        $incident = IncidentService::update($request, $id);

        return redirect()->route('incident.edit', $incident)->with('message', 'Saved!');
    }
}
