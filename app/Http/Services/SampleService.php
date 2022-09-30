<?php

namespace App\Http\Services;

use App\Models\Sample;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class SampleService
{
    public static function index(): Collection
    {
        return Sample::orderBy('id', 'desc')->get();
    }

    public static function store(Request $request): void
    {
        DB::transaction(function () use ($request) {
            foreach ($request->samples as $sample) {
                $newSample = Sample::create($sample);

                if (isset($sample['tests'])) {
                    $newSample->tests()->createMany($sample['tests']);
                }

                if (isset($sample['storage_id'])) {
                    $newSample->custodies()->create(['storage_id' => $sample['storage_id']]);
                }
            }
        });
    }

    public static function findByIds(string $ids): Collection
    {
        return Sample::whereIn('id', explode(',', $ids))->get();
    }

    public static function updateByIds(Request $request): void
    {
        DB::transaction(function () use ($request) {
            foreach ($request->samples as $sample) {
                if (isset($sample['restore'])) {
                    $updateSample = Sample::withTrashed()->where('id', $sample['id'])->first();

                    $updateSample->restore();
                } else {
                    $updateSample = Sample::find($sample['id']);
                    
                    $updateSample->update($sample);

                    if (isset($sample['tests'])) {
                        $updateSample->tests()->createMany($sample['tests']);
                    }

                    if (isset($sample['storage_id']) && $sample['storage_id'] != $updateSample->lastCustody?->storage->id) {
                        $updateSample->custodies()->create(['storage_id' => $sample['storage_id']]);
                    }
                }
            }
        });
    }

    public static function destroy(Sample $sample): void
    {
        $sample->delete();
    }
}
