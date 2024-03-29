<?php

namespace App\Http\Controllers\Api\V1\Invokables;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class Enum extends Controller
{
    public function __invoke(string $name)
    {
        switch (Str::lower($name)) {
            case 'custodytype':
                return \App\Enums\CustodyType::getValues();
                break;

            case 'sampletype':
                return \App\Enums\SampleType::getValues();
                break;

            case 'status':
                return \App\Enums\Status::getValues();
                break;

            case 'storagetype':
                return \App\Enums\StorageType::getValues();
                break;

            case 'unitmeasurement':
                return \App\Enums\UnitMeasurement::getValues();
                break;

            default:
                Log::error('Enum not found: ' . $name);

                return response('Enum not found', 404);

                break;
        }
    }
}
