<?php

namespace App\Database\Models;

use App\Database\Model;
use App\Database\Models\User;

class Popularity extends Model {

    protected $table = 'popularities';
    protected $visible = [
        self::ID,
        self::SENDER_ID,
        self::RECEIVER_ID,
        self::POINT,
        self::CREATED_AT
    ];

    const SENDER_ID   = 'sender_id';
    const RECEIVER_ID = 'receiver_id';
    const POINT       = 'point';
    const CREATED_AT  = 'created_at';


    public function receiverQuery()
    {
        return inst(User::class)->aliasQuery()
            ->qWhere(User::ID, $this->{static::RECEIVER_ID});
    }

    public function senderQuery()
    {
        return inst(User::class)->aliasQuery()
            ->qWhere(User::ID, $this->{static::SENDER_ID});
    }

}
