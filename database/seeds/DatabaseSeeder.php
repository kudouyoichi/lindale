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
        $this->call(WikiTypeSeeder::class);
        $this->call(TaskPrioritySeeder::class);
        $this->call(TodoTypeSeeder::class);
        $this->call(TodoStatusSeeder::class);
    }
}
