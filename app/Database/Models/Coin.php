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

    public function getExpandable()
    {
        return ['balance', 'related', 'user'];
    }

    public function balance()
    {
        return $this->belongsTo(Balance::class, 'balance_id', 'id');
    }

    public function balanceQuery()
    {
        return inst(Balance::class)->query()
            ->qWhere(Balance::ID, $this->{static::BALANCE_ID});
    }

    public function related()
    {
        return $this->belongsTo(Obj::class, 'related_id', 'id');
    }

    public function relatedQuery()
    {
        return inst(Obj::class)->query()
            ->qWhere(Obj::ID, $this->{static::RELATED_ID});
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function userQuery()
    {
        return inst(User::class)->query()
            ->qWhere(User::ID, $this->{static::USER_ID});
    }

}
