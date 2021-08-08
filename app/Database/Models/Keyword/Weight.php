<?php

namespace App\Database\Models\Keyword;

use App\Database\Model;

class Weight extends Model
{
    public const ID = 'id';
    public const TYPE = 'type';

    public const ENTITIES = [
        self::ID,
        self::TYPE,
    ];

    protected $table = 'keyword_weights';
    protected $fillable = [
        self::ID,
        self::TYPE,
    ];
}
