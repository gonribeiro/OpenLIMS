<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Storage;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class StorageController extends Controller
{
    public function index(): Response
    {
        return response(Storage::all());
    }

    public function store(Request $request): Response
    {
        $storage = Storage::create($request->all());

        return response($storage, 201);
    }

    public function show(Storage $storage): Response
    {
        return response($storage);
    }

    public function update(Request $request, int $id): Response
    {
        if ($request->restore) {
            $storage = Storage::withTrashed()->where('id', $id)->first();

            $storage->restore();
        } else {
            $storage = Storage::find($id);

            $storage->update($request->all());
        }

        return response($storage, 204);
    }

    public function destroy(Storage $storage): Response
    {
        $storage->delete();

        return response('Successfully deleted', 204);
    }
}
