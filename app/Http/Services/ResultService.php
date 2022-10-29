<?php

namespace App\Http\Services;

use App\Models\Result;
use App\Models\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ResultService
{
    public static function storeOrUpdate(Request $request)
    {
        DB::transaction(function () use ($request) {
            foreach ($request->results as $results) {
                if (isset($results['test_id'])) {
                    $test = Test::find($results['test_id']);

                    // check if attributes config has been changed
                    if(count(array_diff(
                        array_keys(Arr::except($results, ['test_id', 'result_id'])),
                        Arr::pluck(json_decode($test->analysis->attributes), 'name')
                    )) == 0) {
                        foreach (Arr::except($results, ['test_id', 'result_id']) as $name => $value) {
                            Result::create([
                                'test_id' => $results['test_id'],
                                'name' => $name,
                                'value' => $value,
                                'config' => json_encode(
                                    collect(
                                        json_decode($test->analysis->attributes)
                                    )->where('name', $name)->first()->config
                                )
                            ]);
                        }
                    } else {
                        $message = "Error. Analysis name and result name doesn't match.";

                        Log::error($message);

                        abort('403', $message);
                    }
                } else {
                    foreach (Arr::except($results, ['test_id', 'result_id']) as $value) {
                        $result = Result::find($results['result_id']);

                        $result->update(['value' => $value]);
                    }
                }
            }
        });
    }
}
