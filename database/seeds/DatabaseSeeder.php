<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\User;
use App\Organization;
use App\Vacancy;
//tdickinson@example.net worker
//flatley.lura@example.org employer 

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        //Model::unguard();

        $admin = new User();
        $admin->first_name = 'Inna';
        $admin->email = 'admin@localhost';
        $admin->password = Hash::make('123456');
        $admin->country = 'Ukraine',
        $admin->sity = 'Poltava',
        $admin->role = 'admin',
        $admin->phone = '0637283891'
        $admin->save();


         $this->call(UserTableSeeder::class);
         $this->call(OrganizationTableSeeder::class);
         $this->call(VacancyTableSeeder::class);
         $this->call(UserNextTableSeeder::class);

       
         //Model::reguard();

    }
}