<?php

use App\Permission;
use Illuminate\Database\Seeder;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        // TestDummy::times(20)->create('App\Post');
        $createCompany = new Permission();
        $createCompany->name = 'create-company';
        $createCompany->display_name = 'Create Company';
        $createCompany->description = 'Create new Company';
        $createCompany->save();

        $createCompany = new Permission();
        $createCompany->name = 'edit-company';
        $createCompany->display_name = 'Edit Company';
        $createCompany->description = 'Edit Company';
        $createCompany->save();

        $createCompany = new Permission();
        $createCompany->name = 'delete-company';
        $createCompany->display_name = 'Delete Company';
        $createCompany->description = 'Delete Company';
        $createCompany->save();

    }
}
