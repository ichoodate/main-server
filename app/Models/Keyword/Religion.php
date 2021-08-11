<?php

namespace App\Models\Keyword;

use App\Model;

class Religion extends Model
{
    public const ID = 'id';
    public const TYPE = 'type';

    public const TYPE_IRRELIGION = 'irreligion';
    public const TYPE_CHRISTIANITY = 'christianity';
    public const TYPE_CATHOLICISM = 'catholicism';
    public const TYPE_BUDDHISM = 'buddhism';

    public const TYPE_VALUES = [
        self::TYPE_IRRELIGION,
        self::TYPE_CHRISTIANITY,
        self::TYPE_CATHOLICISM,
        self::TYPE_BUDDHISM,
    ];

    protected $table = 'keyword_religions';
    protected $fillable = [
        self::ID,
        self::TYPE,
    ];
}
