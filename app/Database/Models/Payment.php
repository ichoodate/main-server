<?php

namespace App\Database\Models;

use App\Database\Model;

class Payment extends Model {

    protected $table = 'payments';
    protected $visible = [
        self::ID,
        self::USER_ID,
        self::PRICE,
        self::CURRENCY,
        self::CREATED_AT
    ];

    const USER_ID    = 'user_id';
    const PRICE      = 'price';
    const CURRENCY   = 'currency';
    const CREATED_AT = 'created_at';


    const CURRENCY_KRW = 'KRW';
    const CURRENCY_USD = 'USD';
    const CURRENCY_VALUES = [
        self::CURRENCY_KRW,
        self::CURRENCY_USD
    ];

}
