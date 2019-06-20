<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMatchingKeywordPivotsTable extends Migration {

    public function up()
    {
        Schema::create('matching_keyword_pivots', function(Blueprint $table)
        {
            $table
                ->bigInteger('id')
                ->unsigned();
            $table
                ->bigInteger('ideal_type_kwd_id')
                ->unsigned();
            $table
                ->bigInteger('matching_kwd_id')
                ->unsigned();
            $table
                ->primary('id');
            $table
                ->index('ideal_type_kwd_id');
            $table
                ->index('matching_kwd_id');

            $table
                ->foreign('id')
                ->references('id')
                ->on('objs')
                ->onDelete('cascade');
            $table
                ->foreign('ideal_type_kwd_id')
                ->references('id')
                ->on('objs')
                ->onDelete('cascade');
            $table
                ->foreign('matching_kwd_id')
                ->references('id')
                ->on('objs')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::drop('matching_keyword_pivots');
    }

}
