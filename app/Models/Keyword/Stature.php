<?php

namespace App\Models\Keyword;

use App\Model;

class Stature extends Model
{
    public const CM = 'cm';
    public const ID = 'id';
    public const INCH = 'inch';

    protected $fillable = [
        self::ID,
        self::CM,
        self::INCH,
    ];

    protected $table = 'keyword_statures';
}
