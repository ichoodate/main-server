<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDataFromYqlCountriesTable extends Migration
{
    public function up()
    {
        Schema::create('data_from_yql_countries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('woeid');
            $table->string('iso_3166_1_alpha2');
            $table->timestamps();

            $table->unique('woeid');
            $table->unique('name');
        });
    }

    public function down()
    {
        Schema::drop('data_from_yql_countries');
    }
}
