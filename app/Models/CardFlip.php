<?php

namespace App\Database\Models;

use App\Database\Model;

class CardFlip extends Model
{
    public const ID = 'id';
    public const CARD = 'card';
    public const CARD_ID = 'card_id';
    public const USER = 'user';
    public const USER_ID = 'user_id';
    public const CREATED_AT = 'created_at';

    protected $table = 'card_flips';
    protected $casts = [
        self::ID => 'integer',
        self::USER_ID => 'integer',
        self::CARD_ID => 'integer',
    ];
    protected $fillable = [
        self::ID,
        self::USER_ID,
        self::CARD_ID,
        self::CREATED_AT,
    ];

    public function card()
    {
        return $this->belongsTo(Card::class, 'card_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
