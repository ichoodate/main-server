<?php

namespace App\Database\Models;

use App\Database\Model;
use App\Database\Models\Card;
use App\Database\Models\User;

class CardGroup extends Model {

    protected $table = 'card_groups';
    protected $casts = [
        self::ID => 'integer',
        self::USER_ID => 'integer'
    ];
    protected $fillable = [
        self::ID,
        self::USER_ID,
        self::TYPE,
        self::CREATED_AT
    ];

    const ID         = 'id';
    const CARDS      = 'cards';
    const USER       = 'user';
    const USER_ID    = 'user_id';
    const TYPE       = 'type';
    const CREATED_AT = 'created_at';

    const TYPE_DAILY = 'daily';
    const TYPE_VALUES = [
        self::TYPE_DAILY
    ];

    public function cards()
    {
        return $this->hasMany(Card::class, 'group_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
