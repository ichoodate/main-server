<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateKeywordStatesTable extends Migration
{
    public function down()
    {
        Schema::drop('keyword_states');
    }

    public function up()
    {
        Schema::create('keyword_states', function (Blueprint $table) {
            $table
                ->bigInteger('id')
                ->unsigned()
            ;
            $table
                ->bigInteger('country_id')
                ->unsigned()
            ;
            $table
                ->string('name')
            ;

            $table
                ->primary('id')
            ;
            $table
                ->index('country_id')
            ;
            $table
                ->index('name')
            ;
        });
    }
}
