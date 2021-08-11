<?php

namespace App\Models\Keyword;

use App\Model;

class Blood extends Model
{
    public const ID = 'id';
    public const TYPE = 'type';

    public const TYPE_A = 'A';
    public const TYPE_B = 'B';
    public const TYPE_O = 'O';
    public const TYPE_AB = 'AB';

    public const TYPE_VALUES = [
        self::TYPE_A,
        self::TYPE_B,
        self::TYPE_O,
        self::TYPE_AB,
    ];

    protected $table = 'keyword_bloods';
    protected $fillable = [
        self::ID,
        self::TYPE,
    ];
}
