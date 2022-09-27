<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorageRequest;
use App\Http\Services\StorageService;
use App\Models\Storage;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class StorageController extends Controller
{
    public function index(): View
    {
        return view('storage.index');
    }

    public function create(): View
    {
        return view('storage.form');
    }

    public function store(StorageRequest $request): RedirectResponse
    {
        $storage = StorageService::store($request);

        return redirect()->route('storage.edit', $storage)->with('message', 'Saved!');
    }

    public function edit(Storage $storage): View
    {
        return view('storage.form', compact('storage'));
    }

    public function update(StorageRequest $request, int $id): RedirectResponse
    {
        $storage = StorageService::update($request, $id);

        return redirect()->route('storage.edit', $storage)->with('message', 'Saved!');
    }
}
