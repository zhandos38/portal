<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shedules', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('semester_id');
            $table->string('group_id');
            $table->string('teacher_id');
            $table->string('subject_id');
            $table->string('lesson_id');
            $table->string('day_id');
            $table->string('start');
            $table->string('end');
            $table->string('cabinet');
            $table->softDeletes();
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
        Schema::dropIfExists('shedules');
    }
}
