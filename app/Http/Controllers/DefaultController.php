<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\ProcessPodcast;
use App\Task;
use App\Timesheet;
use App\TaskGroup;

class DefaultController extends Controller
{
    public function index() {


        $podcast = array();
//        ProcessPodcast::dispatch($podcast);

        return array('tab' => TaskGroup::all());
    }
}
