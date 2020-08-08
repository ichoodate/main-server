<?php

namespace App\Database\Models;

use App\Database\Model;
use App\Database\Models\Card;
use App\Database\Models\User;

class CardFlip extends Model {

    protected $table = 'card_flips';
    protected $casts = [
        self::ID => 'integer',
        self::USER_ID => 'integer',
        self::CARD_ID => 'integer'
    ];
    protected $fillable = [
        self::ID,
        self::USER_ID,
        self::CARD_ID,
        self::CREATED_AT
    ];

    const ID         = 'id';
    const CARD       = 'card';
    const CARD_ID    = 'card_id';
    const USER       = 'user';
    const USER_ID    = 'user_id';
    const CREATED_AT = 'created_at';

    public function card()
    {
        return $this->belongsTo(Card::class, 'card_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
