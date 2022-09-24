<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Test;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TestController extends Controller
{
    public function update(Request $request, Test $test): Response
    {
        $test->update($request->all());

        return response($test, 204);
    }

    public function destroy(Test $test): Response
    {
        $test->delete();

        return response('Successfully deleted', 204);
    }
}
