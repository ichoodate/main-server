<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateKeywordBodiesTable extends Migration
{
    public function down()
    {
        Schema::drop('keyword_bodies');
    }

    public function up()
    {
        Schema::create('keyword_bodies', function (Blueprint $table) {
            $table
                ->bigInteger('id')
                ->unsigned()
            ;
            $table
                ->string('type')
            ;

            $table
                ->primary('id')
            ;
            $table
                ->unique('type')
            ;
        });
    }
}
