<?php

namespace App\Repositories;

use App\Models\User;

class UserRepositoryImplement implements UserRepositoryInterface
{
    public function create(array $data)
    {
        User::create($data);
    }
}
