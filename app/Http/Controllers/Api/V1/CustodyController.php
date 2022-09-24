<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Custody;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class CustodyController extends Controller
{
    private function store(Request $request, string $sampleModel)
    {
        try {
            DB::transaction(function () use ($request, $sampleModel) {
                foreach ($request->custodies as $sampleCustody) {
                    $newCustody = new Custody($sampleCustody);

                    $newCustody->sample_type = $sampleModel; // Sample or Subsample

                    $newCustody->save();
                }
            });
        } catch (\Throwable $th) {
            return response($th, 409);
        }
    }

    public function custodiesBySample(string $sampleType, int $sampleId): Response
    {
        $custodies = Custody::where('sample_type', $sampleType)
            ->where('sample_id', $sampleId)
            ->get();

        if ($custodies->isEmpty()) {
            return response('Not Found', 404);
        }

        return response($custodies);
    }

    public function storeSample(Request $request): Response
    {
        $this->store($request, 'Sample');

        return response(201);
    }

    public function storeSubsample(Request $request): Response
    {
        $this->store($request, 'Subsample');

        return response(201);
    }
}
