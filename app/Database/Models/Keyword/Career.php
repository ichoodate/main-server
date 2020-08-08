<?php

namespace App\Database\Models\Keyword;

use App\Database\Model;

class Career extends Model {

    protected $table = 'keyword_careers';
    protected $fillable = [
        self::ID,
        self::PARENT_ID,
        self::TYPE,
        self::NAME
    ];

    const ID        = 'id';
    const PARENT_ID = 'parent_id';
    const TYPE      = 'type';
    const NAME      = 'name';

    const TYPE_TABLE     = 'table';
    const TYPE_SECTION   = 'section';
    const TYPE_DIVISION  = 'division';
    const TYPE_GROUP     = 'group';
    const TYPE_CLASS     = 'class';
    const TYPE_SUB_CLASS = 'sub_class';

    const TYPE_VALUES = [
        self::TYPE_TABLE,
        self::TYPE_SECTION,
        self::TYPE_DIVISION,
        self::TYPE_GROUP,
        self::TYPE_CLASS,
        self::TYPE_SUB_CLASS
    ];
}
