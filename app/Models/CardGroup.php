<?php

namespace App\Models;

use App\Model;

class CardGroup extends Model
{
    public const CARDS = 'cards';
    public const CREATED_AT = 'created_at';
    public const ID = 'id';
    public const TYPE = 'type';
    public const TYPE_VALUES = [
        'daily',
    ];
    public const USER = 'user';
    public const USER_ID = 'user_id';
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

    protected $table = 'card_groups';

    public function cards()
    {
        return $this->hasMany(Card::class, 'group_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
