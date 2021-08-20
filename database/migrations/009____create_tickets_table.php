<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTicketsTable extends Migration
{
    public function down()
    {
        Schema::drop('tickets');
    }

    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table
                ->bigInteger('id')
                ->unsigned()
            ;
            $table
                ->bigInteger('writer_id')
                ->unsigned()
            ;
            $table
                ->string('subject')
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
                ->foreign('id')
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
}
