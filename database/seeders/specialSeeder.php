<?php

namespace Database\Seeders;

use App\Models\DishSpecial;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class specialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DishSpecial::create([
            'dish_name'=>'pasta',
            'dish_title'=>'pasta welldone pasta',
            'dish_desc_top'=>'pasta ,Lorem, ipsum dolor sit amet consectetur adipisicing elit. Dicta accusamus accusantium laudantium sed fugiat rerum.',
            'dish_desc_bottom'=>'pasta Lorem, ipsum dolor sit amet consectetur Lorem ipsum dolor sit amet. adipisicing elit. Dicta accusamus accusantium laudantium sed fugiat rerum.',
            'dish_image'=> 'baked-chicken-breast-vegetable-light-background-top-view-free-space-text-meat-dish-food-white-plate-healthy-baked-179881787.jpg'
        ]);
    }
}
