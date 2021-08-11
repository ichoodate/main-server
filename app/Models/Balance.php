<?php

namespace App\Database\Models;

use App\Database\Model;

class Balance extends Model
{
    public const ID = 'id';
    public const USER_ID = 'user_id';
    public const TYPE = 'type';
    public const COUNT = 'count';
    public const CREATED_AT = 'created_at';
    public const DELETED_AT = 'deleted_at';

    public const TYPE_BASIC = 'basic';

    public const TYPE_VALUES = [
        self::TYPE_BASIC,
    ];

    protected $table = 'balances';
    protected $casts = [
        self::ID => 'integer',
        self::USER_ID => 'integer',
        self::COUNT => 'integer',
    ];
    protected $fillable = [
        self::ID,
        self::USER_ID,
        self::TYPE,
        self::COUNT,
        self::CREATED_AT,
        self::DELETED_AT,
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
