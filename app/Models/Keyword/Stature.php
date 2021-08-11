<?php

namespace App\Models\Keyword;

use App\Model;

class Stature extends Model
{
    public const ID = 'id';
    public const CM = 'cm';
    public const INCH = 'inch';

    public const ENTITIES = [
        self::ID,
        self::CM,
        self::INCH,
    ];

    protected $table = 'keyword_statures';
    protected $fillable = [
        self::ID,
        self::CM,
        self::INCH,
    ];
}
