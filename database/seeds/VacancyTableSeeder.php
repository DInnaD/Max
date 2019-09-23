<?php

use Illuminate\Database\Seeder;
use App\Vacancy;

class VacancyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Organization::whereBetween('id', [1,49])->each(function ($organization) {
            $organization->vacancies()->save(factory(App\Vacancy::class)->make());
            });
    }
}
