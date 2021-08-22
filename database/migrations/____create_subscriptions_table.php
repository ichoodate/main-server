<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSubscriptionsTable extends Migration
{
    public function down()
    {
        Schema::drop('subscriptions');
    }

    public function up()
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table
                ->bigInteger('id')
                ->unsigned()
            ;
            $table
                ->bigInteger('user_id')
                ->unsigned()
            ;
            $table
                ->bigInteger('payment_id')
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
                ->timestamp('deleted_at')
                ->nullable()
            ;

            $table
                ->primary('id')
            ;
            $table
                ->index('user_id')
            ;
            $table
                ->index('payment_id')
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
