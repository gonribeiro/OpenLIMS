<?php

namespace App\Http\Controllers;

use App\Http\Requests\SampleQuantityCreateDialogRequest;
use App\Http\Requests\SampleRequest;
use App\Http\Services\SampleService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Illuminate\Support\Arr;

class SampleController extends Controller
{
    public function index(): View
    {
        return view('sample.index');
    }

    public function quantityCreateDialog(): View
    {
        return view('sample.quantityCreateDialog');
    }

    public function create(SampleQuantityCreateDialogRequest $request): View
    {
        return view('sample.form')->with('quantity', $request->quantity);
    }

    public function store(SampleRequest $request): RedirectResponse
    {
        try {
            SampleService::store($request);
        } catch (\Throwable $th) {
            Log::error($th);

            abort('403', 'Error!');
        }

        return redirect()->route('sample.index')->with('message', 'Saved!');
    }

    public function edit(string $ids): View
    {
        $samples = SampleService::findByIds($ids);

        $quantity = $samples->count();

        return view('sample.form', compact('samples', 'quantity'));
    }

    public function updateByIds(SampleRequest $request): RedirectResponse
    {
        try {
            SampleService::updateByIds($request);
        } catch (\Throwable $th) {
            Log::error($th);

            abort('403', 'Error!');
        }

        return redirect()->route('sample.edit', implode(',', Arr::pluck($request->samples, 'id')))
            ->with('message', 'Saved!');
    }
}
