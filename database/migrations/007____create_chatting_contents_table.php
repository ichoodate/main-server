<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateChattingContentsTable extends Migration
{
    public function up()
    {
        Schema::create('chatting_contents', function (Blueprint $table) {
            $table
                ->bigInteger('id')
                ->unsigned()
            ;
            $table
                ->bigInteger('match_id')
                ->unsigned()
            ;
            $table
                ->bigInteger('writer_id')
                ->unsigned()
            ;
            $table
                ->string('message')
            ;
            $table
                ->timestamps()
            ;

            $table
                ->primary('id')
            ;
            $table
                ->index('match_id')
            ;
            $table
                ->index('writer_id')
            ;

            $table
                ->foreign('id')
                ->references('id')
                ->on('objs')
                ->onDelete('cascade')
            ;
            $table
                ->foreign('match_id')
                ->references('id')
                ->on('objs')
                ->onDelete('cascade')
            ;
            $table
                ->foreign('writer_id')
                ->references('id')
                ->on('objs')
                ->onDelete('cascade')
            ;
        });
    }

    public function down()
    {
        Schema::drop('chatting_contents');
    }
}
