<?php

namespace App\Models\Keyword;

use App\Model;

class AgeRange extends Model
{
    public const ID = 'id';
    public const MIN = 'min';
    public const MAX = 'max';

    protected $table = 'keyword_age_ranges';
    protected $fillable = [
        self::ID,
        self::MIN,
        self::MAX,
    ];
}
