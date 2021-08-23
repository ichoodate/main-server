<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateChattingContentsTable extends Migration
{
    public function down()
    {
        Schema::drop('chatting_contents');
    }

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
                ->index('created_at')
            ;
        });
    }
}