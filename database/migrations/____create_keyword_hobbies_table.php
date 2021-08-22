<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateKeywordHobbiesTable extends Migration
{
    public function down()
    {
        Schema::drop('keyword_hobbies');
    }

    public function up()
    {
        Schema::create('keyword_hobbies', function (Blueprint $table) {
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
