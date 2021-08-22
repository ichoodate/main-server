<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateKeywordCountriesTable extends Migration
{
    public function down()
    {
        Schema::drop('keyword_countries');
    }

    public function up()
    {
        Schema::create('keyword_countries', function (Blueprint $table) {
            $table
                ->bigInteger('id')
                ->unsigned()
            ;
            $table
                ->string('iso') // iso_3166_1_alpha2
            ;
            $table
                ->string('name') // iso_3166_1_alpha2
            ;
            $table
                ->integer('e164')
                ->unsigned()
            ;
            $table
                ->string('cctld')
                ->nullable()
            ;
            $table
                ->string('currency')
                ->nullable()
            ;
            $table
                ->string('language')
                ->nullable()
            ;

            $table
                ->primary('id')
            ;
            $table
                ->unique('iso') // iso_3166_1_alpha2
            ;
        });
    }
}
