<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMatchesTable extends Migration
{
    public function down()
    {
        Schema::drop('matches');
    }

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
        });
    }
}
