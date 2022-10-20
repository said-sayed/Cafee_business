<?php

namespace Database\Seeders;

use App\Models\Chef;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChefSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Chef::create([
            'name'=>'said sayed',
            'job_title'=>'Master Chef',
            'image'=>'_Chef1662470102.jpg'
        ]);
    }
}
