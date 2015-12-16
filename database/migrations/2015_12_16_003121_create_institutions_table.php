<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInstitutionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create ('institutions', function (Blueprint $table) {
            $table->increments ('id');
            $table->string ('name');
            $table->string ('slug', 25);
            $table->string ('address');
            $table->string ('city');
            $table->integer ('zip');
            $table->string ('country');
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
        Schema::drop ('institutions');
    }
}
