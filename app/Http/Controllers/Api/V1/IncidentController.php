<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Incident;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class IncidentController extends Controller
{
    public function index(): Response
    {
        return response(Incident::orderBy('id', 'desc')->get());
    }

    public function store(Request $request)
    {
        $incident = Incident::create($request->all());

        if (isset($request['samples'])) {
            $incident->samples()->attach($request['samples']);
        }

        if (isset($request['subsamples'])) {
            $incident->subsamples()->attach($request['subsamples']);
        }

        return response($incident, 201);
    }

    public function show(Incident $incident): Response
    {
        return response($incident);
    }

    public function update(Request $request, int $id): Response
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
