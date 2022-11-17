<?php

namespace App\Http\Services;

use App\Models\Subsample;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class SubsampleService
{
    public static function index(): Collection
    {
        return Subsample::orderBy('id', 'desc')->get();
    }

    // public static function store(Request $request): void
    // {
    //     DB::transaction(function () use ($request) {
    //         foreach ($request->subsamples as $subsample) {
    //             $newSubsample = Subsample::create($subsample);

    //             if (isset($subsample['tests'])) {
    //                 $newSubsample->tests()->createMany($subsample['tests']);
    //             }

    //             if (isset($subsample['storage_id'])) {
    //                 $newSubsample->custodies()->create(['storage_id' => $subsample['storage_id']]);
    //             }
    //         }
    //     });
    // }

    // public static function findByIds(string $ids): Collection
    // {
    //     return Subsample::whereIn('id', explode(',', $ids))->get();
    // }

    // public static function findByIdsWhereHasTests(string $ids): Collection
    // {
    //     return Subsample::whereIn('id', explode(',', $ids))->whereHas('tests')->get();
    // }

    // public static function findByIdsWhereDoesntHaveTests(string $ids): Collection
    // {
    //     return Subsample::whereIn('id', explode(',', $ids))->whereDoesntHave('tests')->get();
    // }

    public static function updateByIds(Request $request): void
    {
        DB::transaction(function () use ($request) {
            foreach ($request->subsamples as $subsample) {
                if (isset($subsample['restore'])) {
                    $updateSubsample = Subsample::withTrashed()->where('id', $subsample['id'])->first();

                    $updateSubsample->restore();
                } else {
                    $updateSubsample = Subsample::find($subsample['id']);

                    $updateSubsample->update($subsample);
                }
            }
        });
    }

    // public static function destroy(Subsample $subsample): void
    // {
    //     $subsample->delete();
    // }
}
