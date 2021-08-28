<?php

namespace App\Models;

use App\Model;

class RequiredItem extends Model
{
    public const COUNT = 'count';
    public const ID = 'id';
    public const TYPE = 'type';
    public const WHEN = 'when';

    protected $casts = [
        self::ID => 'integer',
        self::COUNT => 'integer',
    ];
    protected $fillable = [
        self::ID,
        self::COUNT,
        self::TYPE,
        self::WHEN,
    ];

    protected $table = 'required_items';
}
