<?php

namespace App\Database\Models\Keyword;

use App\Database\Model;

class Smoke extends Model {

    protected $table = 'keyword_smokes';
    protected $fillable = [
        self::ID,
        self::TYPE
    ];

    const ID   = 'id';
    const TYPE = 'type';

    const ENTITIES = [
        self::ID,
        self::TYPE
    ];

    const TYPE_VALUES = [
        'smoker',
        'non_smoker'
    ];
}
