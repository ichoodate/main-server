<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateKeywordWeightRangesTable extends Migration {

    public function up()
    {
        Schema::create('keyword_weight_ranges', function(Blueprint $table)
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
        Schema::drop('keyword_weight_ranges');
    }

}
