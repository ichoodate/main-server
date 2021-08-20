<?php

namespace App\Models\Keyword;

use App\Model;

class Drink extends Model
{
    public const ID = 'id';
    public const TYPE = 'type';
    public const TYPE_A_LITTLE_FREQUENTLY = 'a_little_frequently';
    public const TYPE_A_LOT_FREQUENTLY = 'a_lot_frequently';

    public const TYPE_CAN_NOT = 'can_not';
    public const TYPE_DO_NOT = 'do_not';
    public const TYPE_OCCASIONALLY = 'occasionally';

    public const TYPE_VALUES = [
        self::TYPE_CAN_NOT,
        self::TYPE_DO_NOT,
        self::TYPE_OCCASIONALLY,
        self::TYPE_A_LITTLE_FREQUENTLY,
        self::TYPE_A_LOT_FREQUENTLY,
    ];
    protected $fillable = [
        self::ID,
        self::TYPE,
    ];

    protected $table = 'keyword_drinks';
}
