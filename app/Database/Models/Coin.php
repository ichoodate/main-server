<?php

namespace App\Database\Models;

use App\Database\Model;
use App\Database\Models\Obj;
use App\Database\Models\User;

class Coin extends Model {

    protected $table = 'coins';
    protected $visible = [
        self::ID,
        self::USER_ID,
        self::RELATED_ID,
        self::COUNT,
        self::CREATED_AT
    ];

    const USER_ID    = 'user_id';
    const COUNT      = 'count';
    const RELATED_ID = 'related_id';
    const CREATED_AT = 'created_at';

    public function userQuery()
    {
        return inst(User::class)->aliasQuery()
            ->qWhere(User::ID, $this->{static::USER_ID});
    }

    public function relatedQuery()
    {
        return inst(Obj::class)->aliasQuery()
            ->qWhere(Obj::ID, $this->{static::RELATED_ID});
    }

}
