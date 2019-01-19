<?php

namespace App\Database\Models;

use App\Database\Model;
use App\Database\Models\User;

class ProfilePhoto extends Model {

    protected $table = 'profile_photos';
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer'
    ];
    protected $visible = [
        self::ID,
        self::USER_ID,
        self::DATA,
        self::CREATED_AT
    ];

    const USER_ID     = 'user_id';
    const DATA        = 'data';
    const CREATED_AT  = 'created_at';

    public function userQuery()
    {
        return inst(User::class)->aliasQuery()
           ->qWhere(User::ID, $this->{static::USER_ID});
    }

}
