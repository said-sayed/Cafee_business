<?php

namespace Database\Seeders;

use App\Models\MenuCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class menuSeeder extends Seeder
{
    public function run()
    {
        $categories = [
            'pizza',
            'Meat'
        ];
        foreach ($categories as $category){

            MenuCategory::create([
                'name' => $category
            ]);
        }
    }
}
