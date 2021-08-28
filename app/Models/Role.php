<?php

namespace App\Models;

use App\Model;

class Role extends Model
{
    public const ID = 'id';
    public const TYPE = 'type';

    public const TYPE_VALUES = [
        'admin',
    ];
    public const USER_ID = 'user_id';
    protected $casts = [
        self::ID => 'integer',
        self::USER_ID => 'integer',
    ];
    protected $fillable = [
        self::ID,
        self::USER_ID,
        self::TYPE,
    ];

    protected $table = 'roles';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
