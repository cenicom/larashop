<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        User::create([
            'name' => 'Luis Eduardo González Vargas',
            'phone' => '3133532295',
            'email' => 'luedgova1967@hotmail.com',
            'profile' => 'Admin',
            'status'=> 'Active',
            'password' => bcrypt('Luis67103050&'),
            'image' => 'https://dummyimage.com/200x150/5c5756/fff'
        ]);

        User::create([
            'name' => 'Luis Eduardo González Vargas',
            'phone' => '3133532295',
            'email' => 'certigascol@hotmail.com',
            'profile' => 'Employee',
            'status'=> 'Active',
            'password' => bcrypt('Luis67103054&'),
            'image' => 'https://dummyimage.com/200x150/5c5756/fff'
        ]);
    }
}
