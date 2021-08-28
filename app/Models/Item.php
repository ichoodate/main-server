<?php

namespace App\Models;

use App\Model;

class Item extends Model
{
    public const CREATED_AT = 'created_at';
    public const CURRENCY = 'currency';
    public const DELETED_AT = 'deleted_at';
    public const FINAL_PRICE = 'final_price';
    public const ID = 'id';
    public const ORIGINAL_PRICE = 'original_price';
    public const TYPE = 'type';
    public const TYPE_VALUES = [
        'coin',
        'subscription',
    ];

    protected $casts = [
        self::ID => 'integer',
    ];
    protected $fillable = [
        self::ID,
        self::TYPE,
        self::ORIGINAL_PRICE,
        self::FINAL_PRICE,
        self::CURRENCY,
        self::CREATED_AT,
        self::DELETED_AT,
    ];

    protected $table = 'items';
}
