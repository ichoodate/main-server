<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePopularitiesTable extends Migration
{
    public function down()
    {
        Schema::drop('popularities');
    }

    public function up()
    {
        Schema::create('popularities', function (Blueprint $table) {
            $table
                ->bigInteger('id')
                ->unsigned()
            ;
            $table
                ->bigInteger('sender_id')
                ->unsigned()
            ;
            $table
                ->bigInteger('receiver_id')
                ->unsigned()
            ;
            $table
                ->tinyInteger('point')
                ->unsigned()
            ;
            $table
                ->timestamps()
            ;

            $table
                ->primary('id')
            ;
            $table
                ->index('sender_id')
            ;
            $table
                ->index('receiver_id')
            ;
            $table
                ->index('created_at')
            ;
        });
    }
}
