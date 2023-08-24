<?php

namespace App\Repositories;

interface CategoryRepositoryInterface
{
    public function getAllData();
    public function create(array $data);
    public function findDataById(int $id);
    public function updateDataById(Int $id, array $data);
    public function deleteDataById(Int $id);
}
