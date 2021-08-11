<?php

namespace App\Database\Models\Keyword;

use App\Database\Model;

class Body extends Model
{
    public const ID = 'id';
    public const TYPE = 'type';

    public const ENTITIES = [
        self::ID,
        self::TYPE,
    ];

    public const TYPE_SLIM = 'slim';
    public const TYPE_LITTLE_SLIM = 'little_slim';
    public const TYPE_NORMAL = 'normal';
    public const TYPE_MUSCULAR = 'muscular';
    public const TYPE_LITTLE_PLUMP = 'little_plump';
    public const TYPE_PLUMP = 'plump';

    public const TYPE_VALUES = [
        self::TYPE_SLIM,
        self::TYPE_LITTLE_SLIM,
        self::TYPE_NORMAL,
        self::TYPE_MUSCULAR,
        self::TYPE_LITTLE_PLUMP,
        self::TYPE_PLUMP,
    ];

    protected $table = 'keyword_bodies';
    protected $fillable = [
        self::ID,
        self::TYPE,
    ];
}
