<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateKeywordReligionsTable extends Migration
{
    public function down()
    {
        Schema::drop('keyword_religions');
    }

    public function up()
    {
        Schema::create('keyword_religions', function (Blueprint $table) {
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
            $table
                ->unique('type')
            ;
        });
    }
}
