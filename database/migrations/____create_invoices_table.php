<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInvoicesTable extends Migration
{
    public function down()
    {
        Schema::drop('invoices');
    }

    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table
                ->bigInteger('id')
                ->unsigned()
            ;
            $table
                ->bigInteger('user_id')
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
                ->index('user_id')
            ;
            $table
                ->index('created_at')
            ;
        });
    }
}
