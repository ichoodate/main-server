<?php

namespace App\Models\Keyword;

use App\Model;

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
    protected $fillable = [
        self::ID,
        self::TYPE,
    ];

    protected $table = 'keyword_hobbies';
}
