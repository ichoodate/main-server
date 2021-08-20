<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateKeywordSchoolsTable extends Migration
{
    public function down()
    {
        Schema::drop('keyword_schools');
    }

    public function up()
    {
        Schema::create('keyword_schools', function (Blueprint $table) {
            $table
                ->bigInteger('id')
                ->unsigned()
            ;
            $table
                ->string('scholarship_id')
            ;
            $table
                ->string('address_id')
            ;
            $table
                ->string('religion_id')
            ;
            $table
                ->string('coed') // coed or men or women
            ;
            $table
                ->string('type')
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
