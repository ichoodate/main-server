<?php

namespace App\Models\Keyword;

use App\Model;

class Career extends Model
{
    public const ID = 'id';
    public const NAME = 'name';
    public const PARENT_ID = 'parent_id';
    public const TYPE = 'type';
    public const TYPE_VALUES = [
        'table',
        'section',
        'division',
        'group',
        'class',
        'sub_class',
    ];

    protected $fillable = [
        self::ID,
        self::PARENT_ID,
        self::TYPE,
        self::NAME,
    ];

    protected $table = 'keyword_careers';
}
