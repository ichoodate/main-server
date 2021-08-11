<?php

use Illuminate\Database\Migrations\Migration;

class CreateSessionsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('sessions', function ($table) {
            $table->string('id');
            $table->text('payload');
            $table->integer('last_activity');

            $table
                ->unique('id')
            ;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('sessions');
    }
}
