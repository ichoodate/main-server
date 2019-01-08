<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePhoneMessagesTable extends Migration {

    public function up()
    {
        Schema::create('phone_messages', function(Blueprint $table)
        {
            $table
                ->bigInteger('id')
                ->unsigned();
            $table
                ->bigInteger('sender_id')
                ->unsigned();
            $table
                ->bigInteger('receiver_id')
                ->unsigned();
            $table
                ->string('type'); // 'auth', 'marketing', 'notification'
            $table
                ->string('status'); // 'reserve','success','waiting','cancel','error'
            $table
                ->text('message');
            $table
                ->timestamp('created_at')
                ->default(app('db')->raw('CURRENT_TIMESTAMP'));

            $table
                ->foreign('sender_id')
                ->references('id')
                ->on('objs')
                ->onDelete('cascade');
            $table
                ->foreign('receiver_id')
                ->references('id')
                ->on('objs')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::drop('phone_messages');
    }

}
