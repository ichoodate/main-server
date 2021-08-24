<?php

namespace App\Models\Keyword;

use App\Model;

class Smoke extends Model
{
    public const ID = 'id';
    public const TYPE = 'type';
    public const TYPE_VALUES = [
        'smoker',
        'non_smoker',
    ];

    protected $fillable = [
        self::ID,
        self::TYPE,
    ];

    protected $table = 'keyword_smokes';
}
