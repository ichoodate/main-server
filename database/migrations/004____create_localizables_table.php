<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLocalizablesTable extends Migration
{
    public function down()
    {
        Schema::drop('localizables');
    }

    public function up()
    {
        Schema::create('localizables', function (Blueprint $table) {
            $table
                ->bigInteger('id')
                ->unsigned()
            ;
            $table
                ->bigInteger('keyword_id')
                ->unsigned()
            ;
            $table
                ->string('language')
            ;
            $table
                ->string('text')
            ;
            $table
                ->timestamps()
            ;

            $table
                ->primary('id')
            ;
            $table
                ->index('keyword_id')
            ;

            $table
                ->foreign('id')
                ->references('id')
                ->on('objs')
                ->onDelete('cascade')
            ;
            $table
                ->foreign('keyword_id')
                ->references('id')
                ->on('objs')
                ->onDelete('cascade')
            ;
        });
    }
}
