<?php

namespace App\Models\Keyword;

use App\Model;

class Religion extends Model
{
    public const ID = 'id';
    public const TYPE = 'type';
    public const TYPE_VALUES = [
        'irreligion',
        'christianity',
        'catholicism',
        'buddhism',
    ];

    protected $fillable = [
        self::ID,
        self::TYPE,
    ];

    protected $table = 'keyword_religions';
}
