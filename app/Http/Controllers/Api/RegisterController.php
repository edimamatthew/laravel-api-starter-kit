<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Actions\RegisterUserAction;
use App\Http\Resources\UserResource;

class RegisterController extends Controller
{
    public function __invoke(RegisterRequest $request, RegisterUserAction $registerUserAction)
    {
        $data = $request->validated();

        $user = $registerUserAction->execute($data);

        return new UserResource($user);

    }
}
