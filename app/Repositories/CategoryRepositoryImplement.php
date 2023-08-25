<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class CategoryRepositoryImplement implements CategoryRepositoryInterface
{
    public function getAllData()
    {
        // get all categories data from db
        $categories = DB::select('select * from categories');

        return $categories;
    }

    public function create(array $data)
    {
        // current time
        $now = now();

        $data['created_at'] = $now;
        $data['updated_at'] = $now;

        // insert new data to table categories
        $data = DB::table('categories')->insert($data);
    }
}
