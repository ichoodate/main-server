<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateIdealTypeKeywordsTable extends Migration
{
    public function down()
    {
        Schema::drop('ideal_type_keywords');
    }

    public function up()
    {
        Schema::create('ideal_type_keywords', function (Blueprint $table) {
            $table
                ->bigInteger('id')
                ->unsigned()
            ;
            $table
                ->bigInteger('user_id')
                ->unsigned()
            ;
            $table
                ->bigInteger('keyword_id')
                ->unsigned()
            ;
            $table
                ->timestamp('created_at')
                ->default(app('db')->raw('CURRENT_TIMESTAMP'))
            ;
            $table
                ->timestamp('deleted_at')
                ->nullable()
            ;

            $table
                ->primary('id')
            ;
            $table
                ->index('keyword_id')
            ;
            $table
                ->index('user_id')
            ;

            $table
                ->foreign('id')
                ->references('id')
                ->on('objs')
                ->onDelete('cascade')
            ;
            $table
                ->foreign('keyword_id')
                ->references('id')
                ->on('objs')
                ->onDelete('cascade')
            ;
            $table
                ->foreign('user_id')
                ->references('id')
                ->on('objs')
                ->onDelete('cascade')
            ;
        });
    }
}
