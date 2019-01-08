<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCountryKeywordsTable extends Migration {

    public function up()
    {
        Schema::create('keyword_countries', function(Blueprint $table)
        {
            $table
                ->bigInteger('id')
                ->unsigned();
            $table
                ->string('iso'); // iso_3166_1_alpha2
            $table
                ->string('name'); // iso_3166_1_alpha2
            $table
                ->integer('e164')
                ->unsigned();
            $table
                ->string('cctld')
                ->nullable();
            $table
                ->string('currency')
                ->nullable();
            $table
                ->string('languages')
                ->nullable();

            $table
                ->primary('id')
                ->foreign('id')
                ->references('id')
                ->on('objs')
                ->onDelete('cascade');
            $table
                ->unique('iso'); // iso_3166_1_alpha2
        });
    }

    public function down()
    {
        Schema::drop('keyword_countries');
    }

}
