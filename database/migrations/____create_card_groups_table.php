<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCardGroupsTable extends Migration
{
    public function down()
    {
        Schema::drop('card_groups');
    }

    public function up()
    {
        Schema::create('card_groups', function (Blueprint $table) {
            $table
                ->bigInteger('id')
                ->unsigned()
            ;
            $table
                ->bigInteger('user_id')
                ->unsigned()
            ;
            $table
                ->string('type')
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
                ->index('type')
            ;
            $table
                ->index('created_at')
            ;
        });
    }
}
