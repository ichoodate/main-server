<?php

namespace App\Database\Models;

use App\Database\Model;
use App\Database\Models\Balance;
use App\Database\Models\Obj;
use App\Database\Models\User;

class Coin extends Model {

    protected $table = 'coins';
    protected $casts = [
        self::ID => 'integer',
        self::USER_ID => 'integer',
        self::BALANCE_ID => 'integer',
        self::RELATED_ID => 'integer',
        self::COUNT => 'integer'
    ];
    protected $fillable = [
        self::ID,
        self::USER_ID,
        self::BALANCE_ID,
        self::RELATED_ID,
        self::COUNT,
        self::CREATED_AT
    ];

    const ID         = 'id';
    const USER_ID    = 'user_id';
    const BALANCE_ID = 'balance_id';
    const RELATED_ID = 'related_id';
    const COUNT      = 'count';
    const CREATED_AT = 'created_at';

    public function balance()
    {
        return $this->belongsTo(Balance::class, 'balance_id', 'id');
    }

    public function related()
    {
        return $this->belongsTo(Obj::class, 'related_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
