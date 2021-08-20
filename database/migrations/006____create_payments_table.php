<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePaymentsTable extends Migration
{
    public function down()
    {
        Schema::drop('payments');
    }

    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table
                ->bigInteger('id')
                ->unsigned()
            ;
            $table
                ->bigInteger('user_id')
                ->unsigned()
            ;
            $table
                ->bigInteger('item_id')
                ->unsigned()
            ;
            $table
                ->string('amount')
            ;
            $table
                ->string('currency')
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
                ->index('item_id')
            ;

            $table
                ->foreign('id')
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
            $table
                ->foreign('item_id')
                ->references('id')
                ->on('objs')
                ->onDelete('cascade')
            ;
        });
    }
}
