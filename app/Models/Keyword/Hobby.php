<?php

namespace App\Database\Models\Keyword;

use App\Database\Model;

class Hobby extends Model
{
    public const ID = 'id';
    public const TYPE = 'type';

    public const TYPE_VALUES = [
        'hobby1',
        'hobby2',
        'hobby3',
        'hobby4',
        'hobby5',
    ];

    protected $table = 'keyword_hobbies';
    protected $fillable = [
        self::ID,
        self::TYPE,
    ];
}
