<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class CategorySeeeder extends Seeder
{
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Category::truncate();

        $data = [
            [
                'name' => 'General',
                'slug' => 'general',
            ]
        ];

        Category::insert($data);
        Schema::enableForeignKeyConstraints();
    }
}
