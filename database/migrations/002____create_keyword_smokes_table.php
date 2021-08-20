<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateKeywordSmokesTable extends Migration
{
    public function down()
    {
        Schema::drop('keyword_smokes');
    }

    public function up()
    {
        Schema::create('keyword_smokes', function (Blueprint $table) {
            $table
                ->bigInteger('id')
                ->unsigned()
            ;
            $table
                ->string('type') // 'smoke', 'no_smoke'
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
