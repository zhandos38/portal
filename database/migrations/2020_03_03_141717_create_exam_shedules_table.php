<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExamShedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_schedules', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("semester_id");
            $table->string("subject_id");
            $table->string("group_id");
            $table->string("type_id");
            $table->string("quiz_id")->default(0);
            $table->string("start");
            $table->string("end");
            $table->string("time");
            $table->string("cabinet");
            $table->string("active")->default(0);
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
        Schema::dropIfExists('exam_shedules');
    }
}
