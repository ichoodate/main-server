<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDrinkKeywordsTable extends Migration {

    public function up()
    {
        Schema::create('keyword_drinks', function(Blueprint $table)
        {
            $table
                ->bigInteger('id')
                ->unsigned();
            $table
                ->string('type');

            $table
                ->primary('id')
                ->foreign('id')
                ->references('id')
                ->on('objs')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::drop('keyword_drinks');
    }

}
