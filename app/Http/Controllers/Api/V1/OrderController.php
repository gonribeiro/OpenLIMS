<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class OrderController extends Controller
{
    public function index(): Response
    {
        return response(Order::all());
    }

    public function store(Request $request): Response
    {
        $order = Order::create($request->all());

        return response($order, 201);
    }

    public function show(Order $order): Response
    {
        return response($order);
    }

    public function update(Request $request, int $id): Response
    {
        if ($request->restore) {
            $order = Order::withTrashed()->where('id', $id)->first();

            $order->restore();
        } else {
            $order = Order::find($id);

            $order->update($request->all());
        }

        return response($order, 204);
    }

    public function destroy(Order $order): Response
    {
        $order->delete();

        return response('Successfully deleted', 204);
    }
}
