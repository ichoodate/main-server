<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration
{
    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('users');
    }

    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table
                ->bigInteger('id')
                ->unsigned()
            ;
            $table
                ->string('email')
            ;
            $table
                ->string('password', 60)
            ;
            $table
                ->string('gender')
            ;
            $table
                ->datetime('birth')
            ;
            $table
                ->string('name')
            ;
            $table
                ->boolean('email_verified')
            ;
            $table
                ->timestamp('created_at')
                ->default(app('db')->raw('CURRENT_TIMESTAMP'))
            ;

            $table
                ->primary('id')
            ;
            $table
                ->unique('email')
            ;

            $table
                ->foreign('id')
                ->references('id')
                ->on('objs')
                ->onDelete('cascade')
            ;
        });
    }
}
