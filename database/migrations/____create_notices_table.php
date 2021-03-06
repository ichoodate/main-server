<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateNoticesTable extends Migration
{
    public function down()
    {
        Schema::drop('notices');
    }

    public function up()
    {
        Schema::create('notices', function (Blueprint $table) {
            $table
                ->bigInteger('id')
                ->unsigned()
            ;
            $table
                ->string('type')
            ;
            $table
                ->string('subject')
            ;
            $table
                ->text('description')
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
                ->index('type')
            ;
            $table
                ->index('created_at')
            ;
        });
    }
}
