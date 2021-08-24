<?php

namespace App\Models\Keyword;

use App\Model;

class Drink extends Model
{
    public const ID = 'id';
    public const TYPE = 'type';
    public const TYPE_VALUES = [
        'can_not',
        'do_not',
        'occasionally',
        'a_little_frequently',
        'a_lot_frequently',
    ];

    protected $fillable = [
        self::ID,
        self::TYPE,
    ];

    protected $table = 'keyword_drinks';
}
