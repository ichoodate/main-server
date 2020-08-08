<?php

namespace App\Database\Models\Keyword;

use App\Database\Model;

class Religion extends Model {

    protected $table = 'keyword_religions';
    protected $fillable = [
        self::ID,
        self::TYPE
    ];

    const ID   = 'id';
    const TYPE = 'type';

    const TYPE_IRRELIGION   = 'irreligion';
    const TYPE_CHRISTIANITY = 'christianity';
    const TYPE_CATHOLICISM  = 'catholicism';
    const TYPE_BUDDHISM     = 'buddhism';

    const TYPE_VALUES = [
        self::TYPE_IRRELIGION,
        self::TYPE_CHRISTIANITY,
        self::TYPE_CATHOLICISM,
        self::TYPE_BUDDHISM
    ];
}
