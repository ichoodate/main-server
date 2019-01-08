<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProfilePhotosTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile_photos', function(Blueprint $table)
        {
            $table
                ->bigInteger('id')
                ->unsigned();
            $table
                ->bigInteger('user_id')
                ->unsigned();
            $table
                ->string('data');
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

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('profile_photos');
    }

}
