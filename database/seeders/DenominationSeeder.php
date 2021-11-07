<?php

namespace Database\Seeders;

use App\Models\Denomination;
use Illuminate\Database\Seeder;

class DenominationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Denomination::create([
            'type' => 'Billete',
            'value' => 100000,
            'image' => 'https://dummyimage.com/200x150/5c5756/fff'
        ]);

        Denomination::create([
            'type' => 'Billete',
            'Value' => 50000,
            'image' => 'https://dummyimage.com/200x150/5c5756/fff'
        ]);

        Denomination::create([
            'type' => 'Billete',
            'Value' => 20000,
            'image' => 'https://dummyimage.com/200x150/5c5756/fff'
        ]);

        Denomination::create([
            'type' => 'Billete',
            'Value' => 10000,
            'image' => 'https://dummyimage.com/200x150/5c5756/fff'
        ]);

        Denomination::create([
            'type' => 'Billete',
            'Value' => 5000,
            'image' => 'https://dummyimage.com/200x150/5c5756/fff'
        ]);

        Denomination::create([
            'type' => 'Billete',
            'Value' => 2000,
            'image' => 'https://dummyimage.com/200x150/5c5756/fff'
        ]);

        Denomination::create([
            'type' => 'Billete',
            'Value' => 1000,
            'image' => 'https://dummyimage.com/200x150/5c5756/fff'
        ]);

        Denomination::create([
            'type' => 'Moneda',
            'Value' => 1000,
            'image' => 'https://dummyimage.com/200x150/5c5756/fff'
        ]);

        Denomination::create([
            'type' => 'Moneda',
            'Value' => 500,
            'image' => 'https://dummyimage.com/200x150/5c5756/fff'
        ]);

        Denomination::create([
            'type' => 'Moneda',
            'Value' => 1000,
            'image' => 'https://dummyimage.com/200x150/5c5756/fff'
        ]);

        Denomination::create([
            'type' => 'Moneda',
            'Value' => 200,
            'image' => 'https://dummyimage.com/200x150/5c5756/fff'
        ]);

        Denomination::create([
            'type' => 'Moneda',
            'Value' => 100,
            'image' => 'https://dummyimage.com/200x150/5c5756/fff'
        ]);

        Denomination::create([
            'type' => 'Moneda',
            'Value' => 0.0,
            'image' => 'https://dummyimage.com/200x150/5c5756/fff'
        ]);

        Denomination::create([
            'type' => 'Otro',
            'Value' => 'Tarjeta Crédito',
            'image' => 'https://dummyimage.com/200x150/5c5756/fff'
        ]);

        Denomination::create([
            'type' => 'Otro',
            'Value' => 'Tarjeta Crédito',
            'image' => 'https://dummyimage.com/200x150/5c5756/fff'
        ]);

        Denomination::create([
            'type' => 'Otro',
            'Value' => 'Tarjeta Debito',
            'image' => 'https://dummyimage.com/200x150/5c5756/fff'
        ]);

        Denomination::create([
            'type' => 'Otro',
            'Value' => 'Cheque',
            'image' => 'https://dummyimage.com/200x150/5c5756/fff'
        ]);

        Denomination::create([
            'type' => 'Otro',
            'Value' => 'Bono Sodexo Pax',
            'image' => 'https://dummyimage.com/200x150/5c5756/fff'
        ]);

        Denomination::create([
            'type' => 'Otro',
            'Value' => 'Nota Crédito',
            'image' => 'https://dummyimage.com/200x150/5c5756/fff'
        ]);

        Denomination::create([
            'type' => 'Otro',
            'Value' => 0,
            'image' => 'https://dummyimage.com/200x150/5c5756/fff'
        ]);
    }
}
