<?php

namespace App\Actions;

use App\User;
use Illuminate\Support\Facades\Hash;

class RegisterUserAction
{
    public function execute(array $data)
    {
        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);

        return $user;
    }
}
