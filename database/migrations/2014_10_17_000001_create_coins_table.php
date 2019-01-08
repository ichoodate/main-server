<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCoinsTable extends Migration {

    public function up()
    {
        Schema::create('coins', function(Blueprint $table)
        {
            $table
                ->bigInteger('id')
                ->unsigned();
            $table
                ->bigInteger('user_id')
                ->unsigned();
            $table
                ->smallInteger('count');
            $table
                ->timestamp('created_at')
                ->default(app('db')->raw('CURRENT_TIMESTAMP'));

            $table
                ->primary('id')
                ->foreign('id')
                ->references('id')
                ->on('objs')
                ->onDelete('cascade');

            $table
                ->foreign('user_id')
                ->references('id')
                ->on('objs')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::drop('coins');
    }

}
