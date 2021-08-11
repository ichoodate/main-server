<?php

namespace App\Database\Models\Keyword;

use App\Database\Model;

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
