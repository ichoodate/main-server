<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBalancesTable extends Migration
{
    public function down()
    {
        Schema::drop('balances');
    }

    public function up()
    {
        Schema::create('balances', function (Blueprint $table) {
            $table
                ->bigInteger('id')
                ->unsigned()
            ;
            $table
                ->bigInteger('user_id')
                ->unsigned()
            ;
            $table
                ->string('type')
            ;
            $table
                ->integer('count')
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
                ->index('user_id')
            ;
        });
    }
}
