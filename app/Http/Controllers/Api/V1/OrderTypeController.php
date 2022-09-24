<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\OrderType;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OrderTypeController extends Controller
{
    public function index(): Response
    {
        return response(OrderType::all());
    }

    public function store(Request $request): Response
    {
        $orderType = OrderType::create($request->all());

        return response($orderType, 201);
    }

    public function show(OrderType $orderType): Response
    {
        return response($orderType);
    }

    public function update(Request $request, int $id): Response
    {
        if ($request->restore) {
            $orderType = OrderType::withTrashed()->where('id', $id)->first();

            $orderType->restore();
        } else {
            $orderType = OrderType::find($id);

            $orderType->update($request->all());
        }

        return response($orderType, 204);
    }

    public function destroy(OrderType $orderType): Response
    {
        $orderType->delete();

        return response('Successfully deleted', 204);
    }
}
