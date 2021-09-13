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
                ->nullable()
            ;
            $table
                ->string('message')
            ;
            $table
                ->boolean('is_read')
                ->default(false)
            ;
            $table
                ->timestamp('created_at')
                ->default(app('db')->raw('CURRENT_TIMESTAMP'))
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
                ->index('is_read')
            ;
            $table
                ->index('created_at')
            ;
        });
    }
}
