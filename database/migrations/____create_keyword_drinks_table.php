<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateKeywordDrinksTable extends Migration
{
    public function down()
    {
        Schema::drop('keyword_drinks');
    }

    public function up()
    {
        Schema::create('keyword_drinks', function (Blueprint $table) {
            $table
                ->bigInteger('id')
                ->unsigned()
            ;
            $table
                ->string('type')
            ;

            $table
                ->primary('id')
            ;
        });
    }
}
