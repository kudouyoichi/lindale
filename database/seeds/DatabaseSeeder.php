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
        $this->call(UserSeeder::class);
        $this->call(ProjectTypeSeeder::class);
        $this->call(ProjectStatusSeeder::class);
        $this->call(ProjectSeeder::class);
    }
}
