<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateKeywordStaturesTable extends Migration
{
    public function down()
    {
        Schema::drop('keyword_statures');
    }

    public function up()
    {
        Schema::create('keyword_statures', function (Blueprint $table) {
            $table
                ->bigInteger('id')
                ->unsigned()
            ;
            $table
                ->string('cm')
            ;
            $table
                ->string('inch')
            ;

            $table
                ->primary('id')
            ;
            $table
                ->index('cm')
            ;
            $table
                ->index('inch')
            ;
        });
    }
}
