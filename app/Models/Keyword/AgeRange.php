<?php

namespace App\Models\Keyword;

use App\Model;

class AgeRange extends Model
{
    public const ID = 'id';
    public const MAX = 'max';
    public const MIN = 'min';

    protected $fillable = [
        self::ID,
        self::MIN,
        self::MAX,
    ];

    protected $table = 'keyword_age_ranges';
}
