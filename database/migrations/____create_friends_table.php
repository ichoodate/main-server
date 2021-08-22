<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFriendsTable extends Migration
{
    public function down()
    {
        Schema::drop('friends');
    }

    public function up()
    {
        Schema::create('friends', function (Blueprint $table) {
            $table
                ->bigInteger('id')
                ->unsigned()
            ;
            $table
                ->bigInteger('match_id')
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
                ->timestamp('created_at')
                ->default(app('db')->raw('CURRENT_TIMESTAMP'))
            ;

            $table
                ->primary('id')
            ;
            $table
                ->index('match_id')
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
