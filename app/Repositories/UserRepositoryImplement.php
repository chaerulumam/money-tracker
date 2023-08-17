<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserRepositoryImplement implements UserRepositoryInterface
{
    public function create(array $data)
    {
        return User::create($data);
    }

    public function attemptLogin(array $credentials)
    {
        return Auth::attempt($credentials);
    }

    public function findByEmail($email)
    {
        return User::where('email', $email)->first();
    }
}
