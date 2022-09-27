<?php

namespace App\Http\Services;

use App\Models\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class StorageService
{
    public static function index(): Collection
    {
        return Storage::orderBy('id', 'desc')->get();
    }

    public static function store(Request $request): Storage
    {
        return Storage::create($request->all());
    }

    public static function update(Request $request, int $id): Storage
    {
        if ($request->restore) {
            $storage = Storage::withTrashed()->where('id', $id)->first();

            $storage->restore();
        } else {
            $storage = Storage::find($id);

            $storage->update($request->all());
        }

        return $storage;
    }

    public static function destroy(Storage $storage): void
    {
        $storage->delete();
    }
}
