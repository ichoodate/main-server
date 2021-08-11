<?php

namespace App\Database\Models\Keyword;

use App\Database\Model;

class StatureRange extends Model
{
    public const ID = 'id';
    public const MIN = 'min';
    public const MAX = 'max';

    public const ENTITIES = [
        self::ID,
        self::MIN,
        self::MAX,
    ];

    protected $table = 'keyword_stature_ranges';
    protected $fillable = [
        self::ID,
        self::MIN,
        self::MAX,
    ];
}
