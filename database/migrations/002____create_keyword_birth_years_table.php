<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateKeywordBirthYearsTable extends Migration
{
    public function down()
    {
        Schema::drop('keyword_birth_years');
    }

    public function up()
    {
        Schema::create('keyword_birth_years', function (Blueprint $table) {
            $table
                ->bigInteger('id')
                ->unsigned()
            ;
            $table
                ->integer('type')
                ->unsigned()
            ;

            $table
                ->primary('id')
                ->foreign('id')
                ->references('id')
                ->on('objs')
                ->onDelete('cascade')
            ;
        });
    }
}
