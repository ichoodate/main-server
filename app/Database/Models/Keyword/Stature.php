<?php

namespace App\Database\Models\Keyword;

use App\Database\Model;

class Stature extends Model {

    protected $table = 'keyword_statures';
    protected $fillable = [
        self::ID,
        self::CM,
        self::INCH
    ];

    const ID   = 'id';
    const CM   = 'cm';
    const INCH = 'inch';

    const ENTITIES = [
        self::ID,
        self::CM,
        self::INCH
    ];
}
