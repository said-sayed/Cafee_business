<?php

namespace Database\Seeders;

use App\Models\ImagesResturant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class imagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ImagesResturant::create([
            'images'=> 'istockphoto-1211547141-612x612.jpg'
        ]);
    }
}
