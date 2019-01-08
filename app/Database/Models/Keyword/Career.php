<?php

namespace App\Database\Models;

use App\Database\Model;

class Career extends Model {

    protected $table = 'keyword_careers';
    protected $visible = [
        self::ID,
        self::PARENT_ID,
        self::CODE,
        self::CATEGORY
    ];

    const PARENT_ID = 'parent_id';
    const CODE      = 'code';
    const CATEGORY  = 'category';

    const CATEGORY_TABLE     = 'table';
    const CATEGORY_SECTION   = 'section';
    const CATEGORY_DIVISION  = 'division';
    const CATEGORY_GROUP     = 'group';
    const CATEGORY_CLASS     = 'class';
    const CATEGORY_SUB_CLASS = 'sub_class';

    const CATEGORY_VALUES = [
        self::CATEGORY_TABLE,
        self::CATEGORY_SECTION,
        self::CATEGORY_DIVISION,
        self::CATEGORY_GROUP,
        self::CATEGORY_CLASS,
        self::CATEGORY_SUB_CLASS
    ];

}
