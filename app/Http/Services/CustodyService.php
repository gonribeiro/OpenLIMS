<?php

namespace App\Http\Services;

use App\Models\Custody;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class CustodyService
{
    public static function store(array $request, string $sampleIds): void
    {
        DB::transaction(function () use ($request, $sampleIds) {
            $samples = SampleService::findByIds($sampleIds);

            foreach ($samples as $sample) {
                if ($request['storage_id'] != $sample->lastCustody?->storage->id) {
                    $sample->custodies()->create($request);
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
