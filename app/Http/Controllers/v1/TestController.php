<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Models\Test;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index()
    {
        return Test::all();
    }

    public function store(Request $request)
    {
        $test = Test::create($request->all());

        return $test;
    }

    public function show(Test $test)
    {
        return $test;
    }

    public function update(Request $request, int $id)
    {
        if ($request->restore) {
            $test = Test::withTrashed()->where('id', $id)->first();

            $test->restore();

            return $test;
        }

        $test = Test::find($id);

        $test->update($request->all());

        return $test;
    }

    public function destroy(Test $test)
    {
        $test->delete();

        return response(200);
    }
}
