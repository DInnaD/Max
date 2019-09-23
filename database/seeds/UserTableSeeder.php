<?php

use App\Organization;
use App\User;
use App\Vacancy;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        factory(App\User::class, 49)->create(['role' => 'employer'])->each(function ($user) {
        $user->organization()->save(factory(Organization::class)->create());
            
        });
    
    }
}
