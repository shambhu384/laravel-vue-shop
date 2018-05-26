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
        $this->call(UserTableDataSeeder::class);
        $this->call(TaskGroupTableDataSeeder::class);
        $this->call(TaskTableDataSeeder::class);
        $this->call(TimesheetTableDataSeeder::class);
        $this->call(TimesheetItemTableDataSeeder::class);
    }
}
