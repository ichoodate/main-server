<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateObjsTable extends Migration
{
    public function down()
    {
        Schema::drop('objs');
    }

    public function up()
    {
        Schema::create('objs', function (Blueprint $table) {
            $table
                ->bigIncrements('id')
            ;
            $table
                ->string('type')
            ;
        });
    }
}
