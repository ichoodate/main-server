<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateKeywordAgeRangesTable extends Migration
{
    public function down()
    {
        Schema::drop('keyword_age_ranges');
    }

    public function up()
    {
        Schema::create('keyword_age_ranges', function (Blueprint $table) {
            $table
                ->bigInteger('id')
                ->unsigned()
            ;
            $table
                ->integer('min')
                ->unsigned()
            ;
            $table
                ->integer('max')
                ->unsigned()
            ;

            $table
                ->primary('id')
            ;
            $table
                ->unique(['min', 'max'])
            ;
        });
    }
}
