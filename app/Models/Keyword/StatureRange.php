<?php

namespace App\Models\Keyword;

use App\Model;

class StatureRange extends Model
{
    public const ID = 'id';
    public const MAX = 'max';
    public const MIN = 'min';

    protected $fillable = [
        self::ID,
        self::MIN,
        self::MAX,
    ];

    protected $table = 'keyword_stature_ranges';
}
