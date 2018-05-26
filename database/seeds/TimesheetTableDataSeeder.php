<?php

use Illuminate\Database\Seeder;

class TimesheetTableDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $data = [
            [ 2, 1, 3, '2018-05-26', 0, null],
            [ 2, 1, 3, '2018-05-27',0, null],
            [ 2, 1, 3, '2018-05-28', 0, null],
            [ 2, 1, 3, '2018-05-28', 0, null],
            [ 2, 1, 3, '2018-05-28',0, null],
        ];
        foreach($data as $item) {
            DB::table('timesheets')->insert([
                'sequence' => $item[0],
                'user_id' => $item[1],
                'task_id' => $item[2],
                'workday' => $item[3],
                'submit' => $item[4]
            ]);
        }
    }
}
