<?php

namespace App\Database\Models;

use App\Database\Model;
use App\Database\Models\Activity;
use App\Database\Models\User;

class Notification extends Model {

    protected $table = 'notifications';
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'activity_id' => 'integer'
    ];
    protected $visible = [
        self::ID,
        self::USER_ID,
        self::ACTIVITY_ID,
        self::CREATED_AT,
        self::UPDATED_AT,
        self::DELETED_AT
    ];

    const USER_ID     = 'user_id';
    const ACTIVITY_ID = 'activity_id';
    const CREATED_AT  = 'created_at';
    const UPDATED_AT  = 'updated_at';
    const DELETED_AT  = 'deleted_at';

    public function userQuery()
    {
        return inst(User::class)->aliasQuery()
            ->qWhere(User::ID, $this->{static::USER_ID});
    }

}
