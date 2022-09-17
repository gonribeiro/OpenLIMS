<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return User::all();
    }

    public function store(Request $request)
    {
        $user = User::create($request->all());

        return $user;
    }

    public function show(User $user)
    {
        return $user;
    }

    public function update(Request $request, int $id)
    {
        if ($request->restore) {
            $user = User::withTrashed()->where('id', $id)->first();

            $user->restore();

            return $user;
        }

        $user = User::find($id);

        $user->update($request->all());

        return $user;
    }

    public function destroy(User $user)
    {
        $user->delete();

        return response(200);
    }
}
