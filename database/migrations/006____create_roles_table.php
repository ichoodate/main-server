<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRolesTable extends Migration
{
    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('roles');
    }

    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table
                ->bigInteger('id')
                ->unsigned()
            ;
            $table
                ->bigInteger('user_id')
                ->unsigned()
            ;
            $table
                ->string('type')
            ;

            $table
                ->primary('id')
            ;
            $table
                ->unique(['user_id', 'type'])
            ;

            $table
                ->foreign('id')
                ->references('id')
                ->on('objs')
                ->onDelete('cascade')
            ;
            $table
                ->foreign('user_id')
                ->references('id')
                ->on('objs')
                ->onDelete('cascade')
            ;
        });
    }
}
