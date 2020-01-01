<?php

use App\Role;
use Illuminate\Database\Seeder;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        // TestDummy::times(20)->create('App\Post');
        $owner = new Role();
        $owner->name = 'owner';
        $owner->display_name = 'Product User';
        $owner->description = 'Product is owner of given project';
        $owner->save();

        $owner = new Role();
        $owner->name = 'admin';
        $owner->display_name = 'Admin User';
        $owner->description = 'Admin is owner of given project';
        $owner->save();
    }
}
