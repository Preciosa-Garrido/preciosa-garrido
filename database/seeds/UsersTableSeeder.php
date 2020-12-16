<?php

use App\User;
use App\Models\Admin;
use App\Models\Gestor;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'name' => 'Dorivaldo Valentim',
            'email' => 'dorivaldovalentim@gmail.com',
            'username' => 'dorivaldovalentim',
            'password' => Hash::make('qwerty'),
        ]);

        Gestor::create([
            'name' => 'Jefth Valentim',
            'email' => 'jefthvalentim@hotmail.com',
            'username' => 'jefthvalentim',
            'password' => Hash::make('1234'),
        ]);

        User::create([
            'first_name' => 'Elizângela',
            'last_name' => 'Valentim',
            'email' => 'elizangelavalentim@gmail.com',
            'phone' => '938161825',
            'address' => 'Luanda, Ngola Kiluanje, Rua Marcone',
            'password' => Hash::make('1234'),
            'foto' => 'user_woman.jpg',
        ]);

        User::create([
            'first_name' => 'Jefth',
            'last_name' => 'Valentim',
            'email' => 'jefthvalentim@hotmail.com',
            'phone' => '938161825',
            'address' => 'Luanda, Ngola Kiluanje, Rua Marcone',
            'password' => Hash::make('1234'),
            'foto' => 'user_man.jpg',
        ]);
        
        User::create([
            'first_name' => 'Dorivaldo',
            'last_name' => 'Valentim',
            'email' => 'dorivaldovalentim@gmail.com',
            'phone' => '938161825',
            'address' => 'Luanda, Ngola Kiluanje, Rua Marcone',
            'password' => Hash::make('1234'),
            'foto' => 'user_man.jpg',
        ]);
    }
}
