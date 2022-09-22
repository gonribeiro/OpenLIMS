<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    public function index(): Response
    {
        return response(User::all());
    }

    public function store(Request $request): Response
    {
        $user = User::create($request->all());

        return response($user, 201);
    }

    public function show(User $user): Response
    {
        return response($user);
    }

    public function update(Request $request, int $id): Response
    {
        if ($request->restore) {
            $user = User::withTrashed()->where('id', $id)->first();

            $user->restore();
        } else {
            $user = User::find($id);

            $user->update($request->all());
        }

        return response($user, 204);
    }

    public function destroy(User $user): Response
    {
        $user->delete();

        return response('Successfully deleted', 204);
    }
}
