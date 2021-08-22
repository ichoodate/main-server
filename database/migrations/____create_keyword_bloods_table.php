<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateKeywordBloodsTable extends Migration
{
    public function down()
    {
        Schema::drop('keyword_bloods');
    }

    public function up()
    {
        Schema::create('keyword_bloods', function (Blueprint $table) {
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
