<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMatchesTable extends Migration
{
    public function up()
    {
        Schema::create('matches', function (Blueprint $table) {
            $table
                ->bigInteger('id')
                ->unsigned()
            ;
            $table
                ->bigInteger('man_id')
                ->unsigned()
            ;
            $table
                ->bigInteger('woman_id')
                ->unsigned()
            ;
            // $table
            //     ->timestamp('created_at')
            //     ->default(app('db')->raw('CURRENT_TIMESTAMP'));
            // $table
            //     ->timestamp('updated_at')
            //     ->default(app('db')->raw('CURRENT_TIMESTAMP'));

            $table
                ->primary('id')
            ;
            $table
                ->index('man_id')
            ;
            $table
                ->index('woman_id')
            ;
            $table
                ->unique(['man_id', 'woman_id'])
            ;

            $table
                ->foreign('id')
                ->references('id')
                ->on('objs')
                ->onDelete('cascade')
            ;
            $table
                ->foreign('man_id')
                ->references('id')
                ->on('objs')
                ->onDelete('cascade')
            ;
            $table
                ->foreign('woman_id')
                ->references('id')
                ->on('objs')
                ->onDelete('cascade')
            ;
        });
    }

    public function down()
    {
        Schema::drop('matches');
    }
}
