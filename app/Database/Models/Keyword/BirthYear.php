<?php

namespace App\Database\Models\Keyword;

use App\Database\Model;

class BirthYear extends Model {

    protected $table = 'keyword_birth_years';
    protected $fillable = [
        self::ID,
        self::TYPE
    ];

    const ID   = 'id';
    const TYPE = 'type';
}
