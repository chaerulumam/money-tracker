<?php

namespace App\Repositories;

interface CategoryRepositoryInterface
{
    public function getAllData();
    public function create(array $data);
}
