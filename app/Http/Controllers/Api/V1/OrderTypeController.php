<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\OrderType;
use Illuminate\Http\Request;

class OrderTypeController extends Controller
{
    public function index()
    {
        return OrderType::all();
    }

    public function store(Request $request)
    {
        $orderType = OrderType::create($request->all());

        return response($orderType, 201);
    }

    public function show(OrderType $orderType)
    {
        return $orderType;
    }

    public function update(Request $request, int $id)
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

    public function destroy(OrderType $orderType)
    {
        $orderType->delete();

        return response('Successfully deleted', 204);
    }
}
