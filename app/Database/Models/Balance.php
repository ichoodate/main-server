<?php

namespace App\Database\Models;

use App\Database\Model;

class Balance extends Model {

    protected $table = 'balances';
    protected $casts = [
        self::ID => 'integer',
        self::USER_ID => 'integer',
        self::COUNT => 'integer'
    ];
    protected $fillable = [
        self::ID,
        self::USER_ID,
        self::TYPE,
        self::COUNT,
        self::CREATED_AT,
        self::DELETED_AT
    ];

    const ID         = 'id';
    const USER_ID    = 'user_id';
    const TYPE       = 'type';
    const COUNT      = 'count';
    const CREATED_AT = 'created_at';
    const DELETED_AT = 'deleted_at';

    const TYPE_BASIC = 'basic';

    const TYPE_VALUES = [
        self::TYPE_BASIC
    ];

    public function getExpandable()
    {
        return ['user'];
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
