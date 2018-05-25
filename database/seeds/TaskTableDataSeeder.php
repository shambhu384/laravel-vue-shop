<?php

use Illuminate\Database\Seeder;

class TaskTableDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $task_groups =  [
            2 => [ 'Design', 'Development', 'Bug Fixing', 'Unit Testing', 'Enhancement Production Support', 'Deployment', 'Guidance/Mentoring', 'Technical Reviews  (Code,Design)'],
            3 => [ 'SOW Preparation', 'Bid Management response', 'Proposal Preparation', 'Client interaction', 'Internal communication'],
            1 => [ 'Trainings & Learning', 'Hiring Interviews', 'Process - Review & Auditing', 'Appraisals', 'Mentoring & Feedback', 'Meetings - Customer & Internal', 'Documentation & Presentation',              'Other Organizational Activities', 'Leave', 'Local Holiday', 'Other Organizational Activities', 'Discretionary  Holiday', 'Anniversary / Festival Celebrations', 'TownHall']
        ];

        foreach($task_groups as $groupid => $task_group) {

            foreach($task_group as $task) {
                DB::table('tasks')->insert([
                    'task_group_id' => $groupid,
                    'name' => $task,
                ]);
            }
        }
    }
}
