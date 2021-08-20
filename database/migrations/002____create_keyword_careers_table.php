<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateKeywordCareersTable extends Migration
{
    public function down()
    {
        Schema::drop('keyword_careers');
    }

    public function up()
    {
        Schema::create('keyword_careers', function (Blueprint $table) {
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
                ->string('type') // 'table', 'section', 'division', 'group', 'class', 'sub_class', 'custom'
            ;
            $table
                ->string('name')
            ;

            $table
                ->primary('id')
                ->foreign('id')
                ->references('id')
                ->on('objs')
                ->onDelete('cascade')
            ;
            $table
                ->foreign('parent_id')
                ->references('id')
                ->on('objs')
                ->onDelete('cascade')
            ;
        });
    }
}
