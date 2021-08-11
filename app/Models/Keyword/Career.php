<?php

namespace App\Database\Models\Keyword;

use App\Database\Model;

class Career extends Model
{
    public const ID = 'id';
    public const PARENT_ID = 'parent_id';
    public const TYPE = 'type';
    public const NAME = 'name';

    public const TYPE_TABLE = 'table';
    public const TYPE_SECTION = 'section';
    public const TYPE_DIVISION = 'division';
    public const TYPE_GROUP = 'group';
    public const TYPE_CLASS = 'class';
    public const TYPE_SUB_CLASS = 'sub_class';

    public const TYPE_VALUES = [
        self::TYPE_TABLE,
        self::TYPE_SECTION,
        self::TYPE_DIVISION,
        self::TYPE_GROUP,
        self::TYPE_CLASS,
        self::TYPE_SUB_CLASS,
    ];

    protected $table = 'keyword_careers';
    protected $fillable = [
        self::ID,
        self::PARENT_ID,
        self::TYPE,
        self::NAME,
    ];
}
