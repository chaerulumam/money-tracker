<?php

namespace App\Repositories;

interface UserRepositoryInterface
{
    public function create(array $data);
    public function attemptLogin(array $credentials);
    public function findByEmail(array $email);
}
