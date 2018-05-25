<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTimesheetItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('timesheet_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('timesheet_id')->unsigned();
            $table->foreign('timesheet_id')->references('id')->on('timesheets');
            $table->unsignedDecimal('hour', 7, 2);
            $table->string('comment', 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('timesheet_items');
    }
}
