<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorageRequest;
use App\Http\Services\StorageService;
use App\Models\Storage;
use Illuminate\Http\Response;

class StorageApiController extends Controller
{
    public function index(): Response
    {
        return response(StorageService::index());
    }

    public function store(StorageRequest $request): Response
    {
        $storage = StorageService::store($request);

        return response($storage, 201);
    }

    public function show(Storage $storage): Response
    {
        return response($storage);
    }

    public function update(StorageRequest $request, int $id): Response
    {
        $storage = StorageService::update($request, $id);

        return response($storage, 204);
    }

    public function destroy(Storage $storage): Response
    {
        StorageService::destroy($storage);

        return response('Successfully deleted', 204);
    }
}
