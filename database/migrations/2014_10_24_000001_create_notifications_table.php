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
                ->bigInteger('receiver_id')
                ->unsigned();
            $table
                ->bigInteger('sender_id')
                ->unsigned();
            $table
                ->timestamp('created_at')
                ->default(app('db')->raw('CURRENT_TIMESTAMP'));
            $table
                ->timestamp('deleted_at')
                ->nullable();

            $table
                ->primary('id')
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
                ->foreign('receiver_id')
                ->references('id')
                ->on('objs')
                ->onDelete('cascade');
            $table
                ->foreign('sender_id')
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
