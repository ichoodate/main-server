<?php

namespace App\Database\Models;

use App\Database\Model;
use App\Database\Models\User;

class Role extends Model {

    protected $table = 'roles';
    protected $casts = [
        self::ID => 'integer',
        self::USER_ID => 'integer'
    ];
    protected $fillable = [
        self::ID,
        self::USER_ID,
        self::TYPE
    ];

    const ID      = 'id';
    const USER_ID = 'user_id';
    const TYPE    = 'type';

    const TYPE_ADMIN  = 'admin';

    const TYPE_VALUES = [
        self::TYPE_ADMIN
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
