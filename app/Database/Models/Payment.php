<?php

namespace App\Database\Models;

use App\Database\Model;
use App\Database\Models\User;
use App\Database\Models\Item;

class Payment extends Model {

    protected $table = 'payments';
    protected $casts = [
        self::ID => 'integer',
        self::USER_ID => 'integer',
        self::ITEM_ID => 'integer'
    ];
    protected $fillable = [
        self::ID,
        self::USER_ID,
        self::ITEM_ID,
        self::AMOUNT,
        self::CURRENCY,
        self::CREATED_AT
    ];

    const ID         = 'id';
    const USER_ID    = 'user_id';
    const ITEM_ID    = 'item_id';
    const AMOUNT     = 'amount';
    const CURRENCY   = 'currency';
    const CREATED_AT = 'created_at';

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
