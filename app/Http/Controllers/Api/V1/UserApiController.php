<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Services\UserService;
use App\Models\User;
use Illuminate\Http\Response;

class UserApiController extends Controller
{
    public function index(): Response
    {
        return response(UserService::index());
    }

    public function store(UserRequest $request): Response
    {
        $user = UserService::store($request);

        return response($user, 201);
    }

    public function show(User $user): Response
    {
        return response($user);
    }

    public function update(UserRequest $request, int $id): Response
    {
        $user = UserService::update($request, $id);

        return response($user, 204);
    }

    public function destroy(User $user): Response
    {
        UserService::destroy($user);

        return response('Successfully deleted', 204);
    }
}
