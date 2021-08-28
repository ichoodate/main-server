<?php

namespace App\Models;

use App\Model;

class Balance extends Model
{
    public const COUNT = 'count';
    public const CREATED_AT = 'created_at';
    public const DELETED_AT = 'deleted_at';
    public const ID = 'id';
    public const TYPE = 'type';
    public const TYPE_VALUES = [
        'basic',
    ];
    public const USER_ID = 'user_id';

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

    protected $table = 'balances';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
