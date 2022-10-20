<?php

namespace Database\Seeders;

use App\Models\OurFeature;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ourFeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OurFeature::create([
            'title' => 'Lorem ipsum dolor sit amet consectetur',
            'description' => ' Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis, architecto!',
        ]);
    }
}
