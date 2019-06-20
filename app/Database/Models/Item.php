<?php

namespace App\Database\Models;

use App\Database\Model;

class Item extends Model {

    protected $table = 'items';
    protected $casts = [
        self::ID => 'integer'
    ];
    protected $fillable = [
        self::ID,
        self::TYPE,
        self::ORIGINAL_PRICE,
        self::FINAL_PRICE,
        self::CURRENCY,
        self::CREATED_AT,
        self::DELETED_AT
    ];

    const ID             = 'id';
    const TYPE           = 'type';
    const ORIGINAL_PRICE = 'original_price';
    const FINAL_PRICE    = 'final_price';
    const CURRENCY       = 'currency';
    const CREATED_AT     = 'created_at';
    const DELETED_AT     = 'deleted_at';

    const TYPE_COIN         = 'coin';
    const TYPE_SUBSCRIPTION = 'subscription';
    const TYPE_VALUES = [
        self::TYPE_COIN,
        self::TYPE_SUBSCRIPTION
    ];

    public function getExpandable()
    {
        return [];
    }

}
