<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Plan::create([
            'title' => 'Starter'
        ]);

        // factory(App\Models\Project::class, 10)->create();
        // $this->call(UsersTableSeeder::class);
    }
}
