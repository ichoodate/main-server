<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCardsTable extends Migration
{
    public function down()
    {
        Schema::drop('cards');
    }

    public function up()
    {
        Schema::create('cards', function (Blueprint $table) {
            $table
                ->bigInteger('id')
                ->unsigned()
            ;
            $table
                ->bigInteger('group_id')
                ->unsigned()
                ->nullable()
            ;
            $table
                ->bigInteger('chooser_id')
                ->unsigned()
            ;
            $table
                ->bigInteger('showner_id')
                ->unsigned()
            ;
            $table
                ->bigInteger('match_id')
                ->unsigned()
            ;
            $table
                ->timestamp('created_at')
                ->default(app('db')->raw('CURRENT_TIMESTAMP'))
            ;
            $table
                ->timestamp('updated_at')
                ->default(app('db')->raw('CURRENT_TIMESTAMP'))
            ;

            $table
                ->primary('id')
            ;
            $table
                ->index('group_id')
            ;
            $table
                ->index('chooser_id')
            ;
            $table
                ->index('showner_id')
            ;
            $table
                ->index('match_id')
            ;
            $table
                ->index('created_at')
            ;
        });
    }
}
