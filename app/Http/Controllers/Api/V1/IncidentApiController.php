<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\IncidentRequest;
use App\Http\Services\IncidentService;
use App\Models\Incident;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class IncidentApiController extends Controller
{
    public function index(): Response
    {
        return response(IncidentService::index());
    }

    public function store(IncidentRequest $request, string $sampleIds): Response
    {
        try {
            IncidentService::store($request->all(), $sampleIds);
        } catch (\Throwable $th) {
            Log::error($th);

            return response($th, 409);
        }

        return response('Created!', 201);
    }

    public function show(Incident $incident): Response
    {
        return response($incident);
    }

    public function update(IncidentRequest $request, int $id): Response
    {
        if ($request->restore) {
            $incident = Incident::withTrashed()->where('id', $id)->first();
            
            $incident->restore();
        } else {
            $incident = Incident::find($id);

            $incident->update($request->all());
        }

        return response($incident, 204);
    }

    public function destroy(Incident $incident): Response
    {
        $incident->delete();

        return response('Successfully deleted', 204);
    }
}
