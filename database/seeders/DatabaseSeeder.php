<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(100)->create();
        
        \App\Models\Product::factory(100)->has(\App\Models\Image::factory()->count(1))->create();

        \App\Models\Order::factory(100)->has(\App\Models\SoldProduct::factory()->count(3))->create();

    }
}
