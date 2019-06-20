<?php

namespace App\Database\Models\Keyword;

use App\Database\Model;

class WeightRange extends Model {

    protected $table = 'keyword_weight_ranges';
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

    public function getExpandable()
    {
        return [];
    }

}
