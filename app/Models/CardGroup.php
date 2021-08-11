<?php

namespace App\Models;

use App\Model;

class CardGroup extends Model
{
    public const ID = 'id';
    public const CARDS = 'cards';
    public const USER = 'user';
    public const USER_ID = 'user_id';
    public const TYPE = 'type';
    public const CREATED_AT = 'created_at';

    public const TYPE_DAILY = 'daily';
    public const TYPE_VALUES = [
        self::TYPE_DAILY,
    ];

    protected $table = 'card_groups';
    protected $casts = [
        self::ID => 'integer',
        self::USER_ID => 'integer',
    ];
    protected $fillable = [
        self::ID,
        self::USER_ID,
        self::TYPE,
        self::CREATED_AT,
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
