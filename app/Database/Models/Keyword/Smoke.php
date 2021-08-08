<?php

namespace App\Database\Models\Keyword;

use App\Database\Model;

class Smoke extends Model
{
    public const ID = 'id';
    public const TYPE = 'type';

    public const ENTITIES = [
        self::ID,
        self::TYPE,
    ];

    public const TYPE_VALUES = [
        'smoker',
        'non_smoker',
    ];

    protected $table = 'keyword_smokes';
    protected $fillable = [
        self::ID,
        self::TYPE,
    ];
}
