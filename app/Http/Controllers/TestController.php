<?php

namespace App\Http\Controllers;

use App\Http\Services\TestService;
use App\Models\Sample;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class TestController extends Controller
{
    public function store(Request $request, string $sampleIds): RedirectResponse
    {
        try {
           TestService::store($request->all(), $sampleIds);
        } catch (\Throwable $th) {
            Log::error($th);

            abort('403', 'Error!');
        }

        return redirect()->route('test.edit', $sampleIds)->with('message', 'Saved!');
    }

    public function edit(Sample $sample): View
    {
        return view('test.form', compact('sample'));
    }
}
