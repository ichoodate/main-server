<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserKeywordsTable extends Migration
{
    public function down()
    {
        Schema::drop('user_keywords');
    }

    public function up()
    {
        Schema::create('user_keywords', function (Blueprint $table) {
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
        });
    }
}
