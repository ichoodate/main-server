<?php

namespace App\Models\Keyword;

use App\Model;

class Blood extends Model
{
    public const ID = 'id';
    public const TYPE = 'type';
    public const TYPE_VALUES = [
        'A',
        'B',
        'O',
        'AB',
    ];

    protected $fillable = [
        self::ID,
        self::TYPE,
    ];

    protected $table = 'keyword_bloods';
}
