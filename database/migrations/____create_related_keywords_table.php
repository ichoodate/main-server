<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRelatedKeywordsTable extends Migration
{
    public function down()
    {
        Schema::drop('related_keywords');
    }

    public function up()
    {
        Schema::create('related_keywords', function (Blueprint $table) {
            $table
                ->bigInteger('id')
                ->unsigned()
            ;
            $table
                ->bigInteger('keyword_id')
                ->unsigned()
            ;
            $table
                ->bigInteger('related_id')
                ->unsigned()
            ;
            $table
                ->primary('id')
            ;
            $table
                ->index('keyword_id')
            ;
            $table
                ->index('related_id')
            ;
        });
    }
}
