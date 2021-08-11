<?php

namespace App\Database\Models;

use App\Database\Model;

class Item extends Model
{
    public const ID = 'id';
    public const TYPE = 'type';
    public const ORIGINAL_PRICE = 'original_price';
    public const FINAL_PRICE = 'final_price';
    public const CURRENCY = 'currency';
    public const CREATED_AT = 'created_at';
    public const DELETED_AT = 'deleted_at';

    public const TYPE_COIN = 'coin';
    public const TYPE_SUBSCRIPTION = 'subscription';
    public const TYPE_VALUES = [
        self::TYPE_COIN,
        self::TYPE_SUBSCRIPTION,
    ];

    protected $table = 'items';
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
}