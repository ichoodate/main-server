<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateKeywordResidencesTable extends Migration
{
    public function down()
    {
        Schema::drop('keyword_residences');
    }

    public function up()
    {
        Schema::create('keyword_residences', function (Blueprint $table) {
            $table
                ->bigInteger('id')
                ->unsigned()
            ;
            $table
                ->bigInteger('parent_id')
                ->unsigned()
                ->nullable()
            ;
            $table
                ->bigInteger('related_id')
                ->unsigned()
            ;

            $table
                ->primary('id')
            ;
            $table
                ->index('parent_id')
            ;
            $table
                ->index('related_id')
            ;
        });
    }
}
