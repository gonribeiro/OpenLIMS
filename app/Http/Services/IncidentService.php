<?php

namespace App\Http\Services;

use App\Models\Incident;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class IncidentService
{
    public static function index(): Collection
    {
        return Incident::orderBy('id', 'desc')->get();
    }

    public static function store(array $request, string $sampleIds): void
    {
        DB::transaction(function () use ($request, $sampleIds) {
            $samples = SampleService::findByIds($sampleIds);

            $incident = Incident::create(Arr::except($request, ['nc']));

            foreach ($samples as $sample) {
                $sample->incidents()->attach($incident->id);
            }
        });
    }

    public static function update(Request $request, int $id): Incident
    {
        if ($request->restore) {
            $incident = Incident::withTrashed()->where('id', $id)->first();

            $incident->restore();
        } else {
            $incident = Incident::find($id);

            $incident->nc = $request->nc ?? 0;

            $incident->update($request->all());
        }

        return $incident;
    }
}
