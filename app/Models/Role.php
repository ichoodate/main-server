<?php

namespace App\Models;

use App\Model;

class Role extends Model
{
    public const ID = 'id';
    public const USER_ID = 'user_id';
    public const TYPE = 'type';

    public const TYPE_ADMIN = 'admin';

    public const TYPE_VALUES = [
        self::TYPE_ADMIN,
    ];

    protected $table = 'roles';
    protected $casts = [
        self::ID => 'integer',
        self::USER_ID => 'integer',
    ];
    protected $fillable = [
        self::ID,
        self::USER_ID,
        self::TYPE,
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
