<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResultRequest;
use App\Http\Services\ResultService;
use App\Http\Services\TestService;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class ResultController extends Controller
{
    public function findResultsByTestIds(string $testIds): View
    {
        $tests = TestService::findByIds($testIds);

        return view('result.form', compact('tests'));
    }

    public function storeOrUpdate(ResultRequest $request)
    {
        try {
            ResultService::storeOrUpdate($request);
        } catch (\Throwable $th) {
            Log::error($th);

            return redirect()->back()->withErrors("Error while attempting update or storage the results.");
        }

        return redirect()->back()->with('message', 'Saved!');
    }
}
