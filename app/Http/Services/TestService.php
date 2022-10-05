<?php

namespace App\Http\Services;

use App\Models\Test;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class TestService
{
    public static function store(array $request, string $sampleIds): void
    {
        DB::transaction(function () use ($request, $sampleIds) {
            $samples = SampleService::findByIds($sampleIds);

            foreach ($samples as $sample) {
                $sample->tests()->createMany($request['tests']);
            }
        });
    }

    public static function findBySampleId(string $sampleType, int $sampleId): Collection
    {
        return Test::where('sample_type', $sampleType)
            ->where('sample_id', $sampleId)
            ->get();
    }

    public static function destroy(Test $test): void
    {
        $test->delete();
    }
}
