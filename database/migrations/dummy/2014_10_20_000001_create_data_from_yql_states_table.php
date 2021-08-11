<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDataFromYqlStatesTable extends Migration
{
    public function up()
    {
        Schema::create('data_from_yql_states', function (Blueprint $table) {
            $table->increments('id');
            $table->string('iso_3166_1_alpha2');
            $table->string('name');
            $table->string('woeid');
            $table->string('place_type');
            $table->timestamps();

            $table->index('iso_3166_1_alpha2');
            $table->index('name');
            $table->unique('woeid');
            $table->index('place_type');
        });
    }

    public function down()
    {
        Schema::drop('data_from_yql_states');
    }
}
