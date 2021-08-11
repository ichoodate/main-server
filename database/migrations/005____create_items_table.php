<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateItemsTable extends Migration
{
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table
                ->bigIncrements('id')
            ;
            $table
                ->string('type')
            ;
            $table
                ->string('original_price')
            ;
            $table
                ->string('final_price')
            ;
            $table
                ->string('currency')
            ;
            $table
                ->timestamp('created_at')
                ->default(app('db')->raw('CURRENT_TIMESTAMP'))
            ;
            $table
                ->timestamp('deleted_at')
                ->nullable()
            ;
        });
    }

    public function down()
    {
        Schema::drop('items');
    }
}
