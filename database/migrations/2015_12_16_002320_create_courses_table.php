<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create ('courses', function (Blueprint $table) {
            $table->increments ('id');
            $table->integer ('assignedOwner')->unsigned()->nullable();
            $table->integer ('assignedInstitution')->unsigned()->nullable();
            $table->string ('courseName');
            $table->longText ('description');
            $table->float ('price');
            $table->date ('startDate');
            $table->integer ('duration');
            $table->timestamps ();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Disable Foreign Key Checks
        DB::statement ('SET FOREIGN_KEY_CHECKS=0;');
        Schema::drop ('courses');
    }
}
