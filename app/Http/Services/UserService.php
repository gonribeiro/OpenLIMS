<?php

namespace App\Http\Services;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class UserService
{
    public static function index(): Collection
    {
        return User::orderBy('id', 'desc')->get();
    }

    public static function store(Request $request): User
    {
        return User::create($request->all());
    }

    public static function update(Request $request, int $id): User
    {
        if ($request->restore) {
            $user = User::withTrashed()->where('id', $id)->first();

            $user->restore();
        } else {
            $user = User::find($id);

            $user->update($request->all());
        }

        return $user;
    }

    public static function destroy(User $user): void
    {
        $user->delete();
    }
}
