<?php

use Illuminate\Database\Seeder;
use App\User;

class OrganizationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	User::whereBetween('id', [2,50])->each(function ($user) {
        	factory(App\Organization::class)->create(['creator_id' => $user->id]);
        });
        //factory(App\Vacancy::class, 49)->create();
    }
}
