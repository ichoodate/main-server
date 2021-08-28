<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRequiredItemsTable extends Migration
{
    public function down()
    {
        Schema::drop('required_items');
    }

    public function up()
    {
        Schema::create('required_items', function (Blueprint $table) {
            $table
                ->bigInteger('id')
                ->unsigned()
            ;
            $table
                ->string('when')
            ;
            $table
                ->string('type')
                ->nullable()
            ;
            $table
                ->smallInteger('count')
                ->unsigned()
                ->nullable()
            ;

            $table
                ->primary('id')
            ;
            $table
                ->index('when')
            ;
            $table
                ->index('type')
            ;
        });
    }
}
