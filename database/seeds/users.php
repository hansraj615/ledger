<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // TestDummy::times(20)->create('App\Post');

        \App\User::create([
            'email' =>'hansraj615@gmail.com',
            'name' =>'Hansraj Sagar',
            'password' =>Hash::make('Saggy123@')
        ]);
    }
}
