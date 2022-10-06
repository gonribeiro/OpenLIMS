<?php

namespace App\Http\Services;

use App\Models\Custody;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustodyService
{
    public static function store(Request $request, string $sampleIds): void
    {
        DB::transaction(function () use ($request, $sampleIds) {
            $samples = SampleService::findByIds($sampleIds);

            foreach ($samples as $sample) {
                if ($request->storage_id != $sample->lastCustody?->storage->id) {
                    $sample->custodies()->create($request->all());
                }
            }
        });
    }

    public static function findBySampleId(string $sampleType, int $sampleId): Collection
    {
        return Custody::where('sample_type', $sampleType)
            ->where('sample_id', $sampleId)
            ->get();
    }
}
