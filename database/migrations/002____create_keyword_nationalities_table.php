<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateKeywordNationalitiesTable extends Migration
{
    public function down()
    {
        Schema::drop('keyword_nationalities');
    }

    public function up()
    {
        Schema::create('keyword_nationalities', function (Blueprint $table) {
            $table
                ->bigInteger('id')
                ->unsigned()
            ;
            $table
                ->bigInteger('country_id')
                ->unsigned()
            ;

            $table
                ->primary('id')
                ->foreign('id')
                ->references('id')
                ->on('objs')
                ->onDelete('cascade')
            ;
            $table
                ->foreign('country_id')
                ->references('id')
                ->on('objs')
                ->onDelete('cascade')
            ;
        });
    }
}
