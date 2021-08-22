<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateKeywordLanguagesTable extends Migration
{
    public function down()
    {
        Schema::drop('keyword_languages');
    }

    public function up()
    {
        Schema::create('keyword_languages', function (Blueprint $table) {
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
