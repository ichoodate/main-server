<?php

namespace App\Database\Models\Keyword;

use App\Database\Model;

class StatureRange extends Model {

    protected $table = 'keyword_stature_ranges';
    protected $fillable = [
        self::ID,
        self::MIN,
        self::MAX
    ];

    const ID   = 'id';
    const MIN  = 'min';
    const MAX  = 'max';

    const ENTITIES = [
        self::ID,
        self::MIN,
        self::MAX,
    ];
}
