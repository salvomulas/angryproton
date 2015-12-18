<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAclTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Creates the roles table
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('label')->nullable();
            $table->timestamps();
        });

        // Creates the permissions table
        Schema::create ('permissions', function (Blueprint $table) {
            $table->increments ('id');
            $table->string ('name');
            $table->string ('label')->nullable ();
            $table->timestamps ();
        });

        // Creates the allocation table to assign permissions to a role
        Schema::create ('permission_role', function (Blueprint $table) {
            $table->integer('permission_id')->unsigned();
            $table->integer('role_id')->unsigned();

            $table->foreign('permission_id')
                ->references('id')
                ->on('permissions')
                ->onDelete('cascade');

            $table->foreign ('role_id')
                ->references ('id')
                ->on ('roles')
                ->onDelete ('cascade');

        });

        // Creates the allocation table to assign roles to a user
        Schema::create ('institution_role_user', function (Blueprint $table) {
            $table->integer ('institution_id')->unsigned ();
            $table->integer ('role_id')->unsigned ();
            $table->integer ('user_id')->unsigned ();

            $table->foreign ('institution_id')
                ->references ('id')
                ->on ('institutions')
                ->onDelete ('cascade');

            $table->foreign ('role_id')
                ->references ('id')
                ->on ('roles')
                ->onDelete ('cascade');

            $table->foreign ('user_id')
                ->references ('id')
                ->on ('users')
                ->onDelete ('cascade');

            $table->primary (['institution_id', 'role_id', 'user_id']);
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

        // Drops the tables
        Schema::drop('roles');
        Schema::drop('permissions');
        Schema::drop('permission_role');
        Schema::drop('institution_role_user');
    }
}
