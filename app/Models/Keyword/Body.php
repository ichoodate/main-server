<?php

namespace App\Models\Keyword;

use App\Model;

class Body extends Model
{
    public const ID = 'id';
    public const TYPE = 'type';
    public const TYPE_VALUES = [
        'slim',
        'little_slim',
        'normal',
        'muscular',
        'little_plump',
        'plump',
    ];

    protected $fillable = [
        self::ID,
        self::TYPE,
    ];

    protected $table = 'keyword_bodies';
}
