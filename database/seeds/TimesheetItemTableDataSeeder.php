<?php

use Illuminate\Database\Seeder;

class TimesheetItemTableDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [ 1, 4.5, 'Comment 1'],
            [ 2, 3.5, 'Comment 2'],
            [ 3, 2.3, 'Comment 3'],
            [ 4, 1, 'Comment 3'],
            [ 2, 1, 'Comment 4'],
        ];
        foreach($data as $item) {
            DB::table('timesheet_items')->insert([
                'timesheet_id' => $item[0],
                'hour' => (int) $item[1],
                'comment' => $item[2]
            ]);
        }
    }
}
