<?php

namespace App\Database\Models\Keyword;

use App\Database\Model;

class Drink extends Model {

    protected $table = 'keyword_drinks';
    protected $fillable = [
        self::ID,
        self::TYPE
    ];

    const ID   = 'id';
    const TYPE = 'type';

    const TYPE_CAN_NOT             = 'can_not';
    const TYPE_DO_NOT              = 'do_not';
    const TYPE_OCCASIONALLY        = 'occasionally';
    const TYPE_A_LITTLE_FREQUENTLY = 'a_little_frequently';
    const TYPE_A_LOT_FREQUENTLY    = 'a_lot_frequently';

    const TYPE_VALUES = [
        self::TYPE_CAN_NOT,
        self::TYPE_DO_NOT,
        self::TYPE_OCCASIONALLY,
        self::TYPE_A_LITTLE_FREQUENTLY,
        self::TYPE_A_LOT_FREQUENTLY
    ];

    public function getExpandable()
    {
        return [];
    }

}
