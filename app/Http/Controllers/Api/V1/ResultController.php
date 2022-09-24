<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Result;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ResultController extends Controller
{
    public function index(): Response
    {
        return response(Result::all());
    }

    public function store(Request $request): Response
    {
        $result = Result::create($request->all());

        return response($result, 201);
    }

    public function show(Result $result): Response
    {
        return response($result);
    }

    public function update(Request $request, int $id): Response
    {
        if ($request->restore) {
            $result = Result::withTrashed()->where('id', $id)->first();

            $result->restore();
        } else {
            $result = Result::find($id);

            $result->update($request->all());
        }

        return response($result, 204);
    }

    public function destroy(Result $result): Response
    {
        $result->delete();

        return response('Successfully deleted', 204);
    }
}
