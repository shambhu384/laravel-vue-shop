<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Timesheet extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'workday', 'submit'
    ];

    /**
     * Get the tasks for the task group
     */
    public function timesheet_items()
    {
        return $this->hasMany('App\TimesheetItem');
    }
}
