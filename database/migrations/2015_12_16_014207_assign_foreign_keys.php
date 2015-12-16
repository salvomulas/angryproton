<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AssignForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Foreign key assignment will run after every table has been created
        Schema::table ('courses', function (Blueprint $table) {
            $table->foreign ('assignedOwner')
                ->references ('id')
                ->on ('users')
                ->onDelete ('cascade')
                ->onUpdate ('cascade');
            $table->foreign ('assignedInstitution')
                ->references ('id')
                ->on ('institutions')
                ->onDelete ('cascade')
                ->onUpdate ('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table ('courses', function (Blueprint $table) {
            $table->dropForeign ('courses_assignedOwner_foreign');
            $table->dropForeign ('courses_assignedInstitution_foreign');
        });
    }
}
