<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Category::create([
            'name' => 'Pañales Desechables',
            'image' => 'https://dummyimage.com/200x150/5c5756/fff'
        ]);

        Category::create([
            'name' => 'Toallitas Desechables',
            'image' => 'https://dummyimage.com/200x150/5c5756/fff'
        ]);

        Category::create([
            'name' => 'Leche en Polvo',
            'image' => 'https://dummyimage.com/200x150/5c5756/fff'
        ]);

        Category::create([
            'name' => 'Caminadores',
            'image' => 'https://dummyimage.com/200x150/5c5756/fff'
        ]);
    }
}
