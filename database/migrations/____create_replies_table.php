<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRepliesTable extends Migration
{
    public function down()
    {
        Schema::drop('replies');
    }

    public function up()
    {
        Schema::create('replies', function (Blueprint $table) {
            $table
                ->bigInteger('id')
                ->unsigned()
            ;
            $table
                ->bigInteger('writer_id')
                ->unsigned()
            ;
            $table
                ->bigInteger('ticket_id')
                ->unsigned()
            ;
            $table
                ->text('description')
            ;
            $table
                ->timestamp('created_at')
                ->default(app('db')->raw('CURRENT_TIMESTAMP'))
            ;
            $table
                ->timestamp('updated_at')
                ->default(app('db')->raw('CURRENT_TIMESTAMP'))
            ;

            $table
                ->primary('id')
            ;
            $table
                ->index('writer_id')
            ;
            $table
                ->index('ticket_id')
            ;
            $table
                ->index('created_at')
            ;
        });
    }
}
