<?php

use Illuminate\Database\Seeder;

class UserNextTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        

        factory(App\User::class, 50)->create(['role' => 'worker'])->each(function ($user) {
        $digits = collect([random_int(1, 49)])->unique();
                foreach ($digits as $digit) {
                    # code...
                    $user->vacancies()->attach($digit);
                }
        });
    }
}
