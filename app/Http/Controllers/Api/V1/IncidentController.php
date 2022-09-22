<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Incident;
use Illuminate\Http\Request;

class IncidentController extends Controller
{
    public function index()
    {
        return Incident::all();
    }

    // public function store(Request $request)
    // {
    //     $incident = Incident::create($request->all());

    //     return response($incident, 201);
    // }

    public function show(Incident $incident)
    {
        return $incident;
    }

    public function update(Request $request, int $id)
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

    public function destroy(Incident $incident)
    {
        $incident->delete();

        return response('Successfully deleted', 204);
    }
}
