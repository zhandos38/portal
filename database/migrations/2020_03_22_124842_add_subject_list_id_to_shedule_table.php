<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSubjectListIdToSheduleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('shedules', function (Blueprint $table) {
            $table->integer('subject_list_id')->after('id');
//            $table->foreign('subject_list_id')->references('id')->on('subject_lists')->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('shedules', function (Blueprint $table) {
            $table->dropColumn(['subject_list_id']);
        });
    }
}
