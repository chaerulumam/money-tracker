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

    public function findDataById(int $id)
    {
        // initialize find id
        $category = DB::table('categories')->where('id', $id)->first();

        // initialize check first
        if (!$category) {
            throw new \Exception('Category not found');
        }

        return $category;
    }

    public function updateDataById(int $id, array $data)
    {
        // initialize find id and update data
        $category = DB::table('categories')->where('id', $id)->update($data);

        // check data first
        if (!$category) {
            throw new \Exception('Update failed');
        }

        return $category;
    }

    public function deleteDataById(int $id)
    {
        // initialize find id and delete data
        $category = DB::table('categories')->where('id', $id)->delete($id);

        // check data first
        if (!$category) {
            throw new \Exception('Delete data failed');
        }

        return $category;
    }
}
