<?php

use Illuminate\Database\Seeder;

class TaskGroupTableDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $groups = ['Organisation', 'Training & Learning', 'Projects', 'Clients'];
        foreach($groups as $group) {
            DB::table('task_groups')->insert([
                'name' => $group
            ]);
        }
    }
}
