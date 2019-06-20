<?php

namespace App\Database\Models\Keyword;

use App\Database\Model;

class Stature extends Model {

    protected $table = 'keyword_statures';
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

    public function getExpandable()
    {
        return [];
    }

}
