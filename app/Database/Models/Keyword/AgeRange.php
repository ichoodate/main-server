<?php

namespace App\Database\Models\Keyword;

use App\Database\Model;

class AgeRange extends Model {

    protected $table = 'keyword_age_ranges';
    protected $fillable = [
        self::ID,
        self::MIN,
        self::MAX
    ];

    const ID  = 'id';
    const MIN = 'min';
    const MAX = 'max';
}
