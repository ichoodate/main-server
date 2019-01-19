<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNotificationsTable extends Migration {

    public function up()
    {
        Schema::create('notifications', function(Blueprint $table)
        {
            $table
                ->bigInteger('id')
                ->unsigned();
            $table
                ->bigInteger('act_id')
                ->unsigned();
            $table
                ->bigInteger('user_id')
                ->unsigned();
            $table
                ->timestamp('created_at')
                ->default(app('db')->raw('CURRENT_TIMESTAMP'));
            $table
                ->timestamp('updated_at')
                ->default(app('db')->raw('CURRENT_TIMESTAMP'));
            $table
                ->timestamp('deleted_at')
                ->nullable();

            $table
                ->primary('id');
            $table
                ->index('act_id');
            $table
                ->index('user_id');

            $table
                ->foreign('id')
                ->references('id')
                ->on('objs')
                ->onDelete('cascade');
            $table
                ->foreign('act_id')
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
        Schema::drop('notifications');
    }

}
