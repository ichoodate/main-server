<?php

namespace App\Database\Models\Keyword;

use App\Database\Model;

class Weight extends Model {

    protected $table = 'keyword_weights';
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
}
