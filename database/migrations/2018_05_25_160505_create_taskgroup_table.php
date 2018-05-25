<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaskgroupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_groups', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->integer('parent')->unsigned()->nullable();
            $table->foreign('parent')->references('id')->on('task_groups');
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
        Schema::dropIfExists('task_groups');
    }
}
