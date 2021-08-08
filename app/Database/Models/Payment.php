<?php

namespace App\Database\Models;

use App\Database\Model;

class Payment extends Model
{
    public const ID = 'id';
    public const USER_ID = 'user_id';
    public const ITEM_ID = 'item_id';
    public const AMOUNT = 'amount';
    public const CURRENCY = 'currency';
    public const CREATED_AT = 'created_at';

    protected $table = 'payments';
    protected $casts = [
        self::ID => 'integer',
        self::USER_ID => 'integer',
        self::ITEM_ID => 'integer',
    ];
    protected $fillable = [
        self::ID,
        self::USER_ID,
        self::ITEM_ID,
        self::AMOUNT,
        self::CURRENCY,
        self::CREATED_AT,
    ];

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
