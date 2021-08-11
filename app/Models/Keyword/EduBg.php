<?php

namespace App\Database\Models\Keyword;

use App\Database\Model;

class EduBg extends Model
{
    public const ID = 'id';
    public const TYPE = 'type';

    public const TYPE_PRIMARY_SCHOOL = 'primary_school';
    public const TYPE_SECONDARY_SCHOOL = 'secondary_school';
    public const TYPE_HIGH_SCHOOL = 'high_school';
    public const TYPE_COLLEGE = 'college';
    public const TYPE_UNIVERSITY = 'university';

    public const TYPE_VALUES = [
        self::TYPE_PRIMARY_SCHOOL,
        self::TYPE_SECONDARY_SCHOOL,
        self::TYPE_HIGH_SCHOOL,
        self::TYPE_COLLEGE,
        self::TYPE_UNIVERSITY,
    ];

    protected $table = 'keyword_edu_bgs';
    protected $fillable = [
        self::ID,
        self::TYPE,
    ];
}
