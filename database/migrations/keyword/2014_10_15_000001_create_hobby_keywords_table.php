<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateHobbyKeywordsTable extends Migration {

    public function up()
    {
        Schema::create('keyword_hobbies', function(Blueprint $table)
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
        Schema::drop('keyword_hobbies');
    }

}
