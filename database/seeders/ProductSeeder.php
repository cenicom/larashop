<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Product::create([
            'name' => 'Pañal Desechable Huggies',
            'barcode'=> '7708529631',
            'cost' => 12550,
            'price' => 15750,
            'stock' => 10,
            'alert' => 10,
            'image' => 'pañal01.png',
            'category_id' => 1,
        ]);

        Product::create([
            'name' => 'Pañal Desechable Huggies',
            'barcode'=> '7708529632',
            'cost' => 13550,
            'price' => 16750,
            'stock' => 10,
            'alert' => 10,
            'image' => 'pañal02.png',
            'category_id' => 1,
        ]);

        Product::create([
            'name' => 'Pañal Desechable Huggies',
            'barcode'=> '7708529633',
            'cost' => 14550,
            'price' => 17750,
            'stock' => 10,
            'alert' => 10,
            'image' => 'pañal03.png',
            'category_id' => 1,
        ]);

        Product::create([
            'name' => 'Toallitas Desechables Huggies',
            'barcode'=> '7808529631',
            'cost' => 12550,
            'price' => 15750,
            'stock' => 10,
            'alert' => 10,
            'image' => 'toalla01.png',
            'category_id' => 2,
        ]);

        Product::create([
            'name' => 'Toallitas Desechables Huggies',
            'barcode'=> '7808529632',
            'cost' => 12550,
            'price' => 15750,
            'stock' => 10,
            'alert' => 10,
            'image' => 'toalla02.png',
            'category_id' => 2,
        ]);

        Product::create([
            'name' => 'Toallitas Desechables Huggies',
            'barcode'=> '7808529633',
            'cost' => 12550,
            'price' => 15750,
            'stock' => 10,
            'alert' => 10,
            'image' => 'toalla03.png',
            'category_id' => 2,
        ]);

        Product::create([
            'name' => 'Leche en Polvo Klim',
            'barcode'=> '7908529631',
            'cost' => 12550,
            'price' => 15750,
            'stock' => 10,
            'alert' => 10,
            'image' => 'tarroleche01.png',
            'category_id' => 3,
        ]);

        Product::create([
            'name' => 'Leche en Polvo Nestogeno',
            'barcode'=> '7908529632',
            'cost' => 12550,
            'price' => 15750,
            'stock' => 10,
            'alert' => 10,
            'image' => 'tarroleche02.png',
            'category_id' => 3,
        ]);

        Product::create([
            'name' => 'Leche en Polvo Nan',
            'barcode'=> '7908529633',
            'cost' => 12550,
            'price' => 15750,
            'stock' => 10,
            'alert' => 10,
            'image' => 'tarroleche03.png',
            'category_id' => 3,
        ]);

        Product::create([
            'name' => 'Caminador Bebe Multijuegos',
            'barcode'=> '8908529631',
            'cost' => 85550,
            'price' => 125750,
            'stock' => 10,
            'alert' => 10,
            'image' => 'caminador01.png',
            'category_id' => 4,
        ]);

        Product::create([
            'name' => 'Caminador Bebe Multijuegos',
            'barcode'=> '8908529632',
            'cost' => 85550,
            'price' => 125750,
            'stock' => 10,
            'alert' => 10,
            'image' => 'caminador02.png',
            'category_id' => 4,
        ]);

        Product::create([
            'name' => 'Caminador Bebe Multijuegos',
            'barcode'=> '8908529633',
            'cost' => 85550,
            'price' => 125750,
            'stock' => 10,
            'alert' => 10,
            'image' => 'caminador03.png',
            'category_id' => 4,
        ]);
    }
}
