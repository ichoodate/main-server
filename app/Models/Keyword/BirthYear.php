<?php

namespace App\Models\Keyword;

use App\Model;

class BirthYear extends Model
{
    public const ID = 'id';
    public const TYPE = 'type';
    protected $fillable = [
        self::ID,
        self::TYPE,
    ];

    protected $table = 'keyword_birth_years';
}
