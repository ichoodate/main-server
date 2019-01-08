<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateIdealTypablesTable extends Migration {

    public function up()
    {
        Schema::create('ideal_typables', function(Blueprint $table)
        {
            $table
                ->bigInteger('id')
                ->unsigned();
            $table
                ->bigInteger('user_id')
                ->unsigned();
            $table
                ->bigInteger('keyword_id')
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
                ->foreign('keyword_id')
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
        Schema::drop('ideal_typables');
    }

}
