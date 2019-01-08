<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
/*        DB::table('departments')->insert([
            'name' => str_random(10),
        ]);*/
        factory(\App\Component::class, 20)->create();

    }
}
