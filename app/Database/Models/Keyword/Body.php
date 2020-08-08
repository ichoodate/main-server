<?php

namespace App\Database\Models\Keyword;

use App\Database\Model;

class Body extends Model {

    protected $table = 'keyword_bodies';
    protected $fillable = [
        self::ID,
        self::TYPE
    ];

    const ID   = 'id';
    const TYPE = 'type';

    const ENTITIES = [
        self::ID,
        self::TYPE
    ];

    const TYPE_SLIM         = 'slim';
    const TYPE_LITTLE_SLIM  = 'little_slim';
    const TYPE_NORMAL       = 'normal';
    const TYPE_MUSCULAR     = 'muscular';
    const TYPE_LITTLE_PLUMP = 'little_plump';
    const TYPE_PLUMP        = 'plump';

    const TYPE_VALUES = [
        self::TYPE_SLIM,
        self::TYPE_LITTLE_SLIM,
        self::TYPE_NORMAL,
        self::TYPE_MUSCULAR,
        self::TYPE_LITTLE_PLUMP,
        self::TYPE_PLUMP
    ];
}
