<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserCourseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_course', function (Blueprint $table) {
            $table->integer ('user_id')->unsigned ();
            $table->integer ('course_id')->unsigned ();
            $table->primary (['user_id', 'course_id']);
            $table->foreign ('user_id')->references('id')->on('users');
            $table->foreign ('course_id')->references('id')->on('courses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Schema::drop('user_course');
    }
}
