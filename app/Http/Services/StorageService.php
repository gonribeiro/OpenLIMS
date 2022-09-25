<?php

namespace App\Http\Services;

use App\Models\Storage;
use Illuminate\Http\Request;

class StorageService
{
    public static function store(Request $request): Storage
    {
        return Storage::create($request->all());
    }

    public static function update(Request $request, int $id): Storage
    {
        if ($request->restore) {
            $user = Storage::withTrashed()->where('id', $id)->first();

            $user->restore();
        } else {
            $user = Storage::find($id);

            $user->update($request->all());
        }

        return $user;
    }

    public static function destroy(Storage $storage): void
    {
        $storage->delete();
    }
}
