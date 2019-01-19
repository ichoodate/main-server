<?php

namespace App\Database\Models;

use App\Database\Model;

class Item extends Model {

    protected $table = 'added_coin';
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'payment_id' => 'integer'
    ];
    protected $visible = [
        self::ID,
        self::USER_ID,
        self::TYPE,
        self::PAYMENT_ID,
        self::CREATED_AT,
        self::DELETED_AT
    ];

    const USER_ID    = 'user_id';
    const TYPE       = 'type';
    const PAYMENT_ID = 'count';
    const CREATED_AT = 'created_at';
    const DELETED_AT = 'deleted_at';


    public function userQuery()
    {
        return inst(User::class)->aliasQuery()
            ->qWhere(User::ID, $this->{static::USER_ID});
    }

    public function paymentQuery()
    {
        return inst(Payment::class)->aliasQuery()
            ->qWhere(Payment::ID, $this->{static::PAYMENT_ID});
    }

}
