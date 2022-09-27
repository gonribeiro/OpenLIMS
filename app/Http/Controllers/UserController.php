<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Services\UserService;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(): View
    {
        return view('user.index');
    }

    public function create(): View
    {
        return view('user.form');
    }

    public function store(UserRequest $request): RedirectResponse
    {
        $user = UserService::store($request);

        return redirect()->route('user.edit', $user)->with('message', 'Saved!');
    }

    public function edit(User $user): View
    {
        return view('user.form', compact('user'));
    }

    public function update(UserRequest $request, int $id): RedirectResponse
    {
        $user = UserService::update($request, $id);

        return redirect()->route('user.edit', $user)->with('message', 'Saved!');
    }
}
