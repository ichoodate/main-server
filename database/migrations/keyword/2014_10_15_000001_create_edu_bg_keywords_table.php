<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEduBgKeywordsTable extends Migration {

    public function up()
    {
        Schema::create('keyword_edu_backgrounds', function(Blueprint $table)
        {
            $table
                ->bigInteger('id')
                ->unsigned();
            $table
                ->string('type'); // 'elementary', 'middle', 'high', 'college', 'university'

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
        Schema::drop('keyword_edu_backgrounds');
    }

}
