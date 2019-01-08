<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStatureRangesTable extends Migration {

    public function up()
    {
        Schema::create('keyword_stature_ranges', function(Blueprint $table)
        {
            $table
                ->bigInteger('id')
                ->unsigned();
            $table
                ->integer('min')
                ->unsigned();
            $table
                ->integer('max')
                ->unsigned();

            $table
                ->primary('id')
                ->foreign('id')
                ->references('id')
                ->on('objs')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::drop('keyword_stature_ranges');
    }

}
