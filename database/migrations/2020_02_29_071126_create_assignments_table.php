<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssignmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assignments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('semester_id');
            $table->string('group_id');
            $table->string('subject_id');
            $table->string('teacher_id');
            $table->string('student_id');
            $table->string('first_rating')->default(0);
            $table->string('second_rating')->default(0);
            $table->string('exam_rating')->default(0);
            $table->string('total_rating')->default(0);
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
        Schema::dropIfExists('assignments');
    }
}
