<?php

namespace App\Models;

use App\Model;

class Coin extends Model
{
    public const BALANCE_ID = 'balance_id';
    public const COUNT = 'count';
    public const CREATED_AT = 'created_at';
    public const ID = 'id';
    public const RELATED_ID = 'related_id';
    public const USER_ID = 'user_id';

    protected $casts = [
        self::ID => 'integer',
        self::USER_ID => 'integer',
        self::BALANCE_ID => 'integer',
        self::RELATED_ID => 'integer',
        self::COUNT => 'integer',
    ];
    protected $fillable = [
        self::ID,
        self::USER_ID,
        self::BALANCE_ID,
        self::RELATED_ID,
        self::COUNT,
        self::CREATED_AT,
    ];

    protected $table = 'coins';

    public function balance()
    {
        return $this->belongsTo(Balance::class, 'balance_id', 'id');
    }

    public function relatedObj()
    {
        return $this->belongsTo(Obj::class, 'related_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
