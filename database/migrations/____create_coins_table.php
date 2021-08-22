<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCoinsTable extends Migration
{
    public function down()
    {
        Schema::drop('coins');
    }

    public function up()
    {
        Schema::create('coins', function (Blueprint $table) {
            $table
                ->bigInteger('id')
                ->unsigned()
            ;
            $table
                ->bigInteger('user_id')
                ->unsigned()
            ;
            $table
                ->bigInteger('balance_id')
                ->unsigned()
            ;
            $table
                ->bigInteger('related_id')
                ->unsigned()
            ;
            $table
                ->smallInteger('count')
            ;
            $table
                ->timestamp('created_at')
                ->default(app('db')->raw('CURRENT_TIMESTAMP'))
            ;

            $table
                ->primary('id')
            ;
            $table
                ->index('user_id')
            ;
            $table
                ->index('balance_id')
            ;
            $table
                ->index('related_id')
            ;
            $table
                ->index('created_at')
            ;
        });
    }
}
