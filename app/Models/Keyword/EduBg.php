<?php

namespace App\Models\Keyword;

use App\Model;

class EduBg extends Model
{
    public const ID = 'id';
    public const TYPE = 'type';
    public const TYPE_VALUES = [
        'college',
        'high_school',
        'elementary_school',
        'middle_school',
        'university',
    ];

    protected $fillable = [
        self::ID,
        self::TYPE,
    ];

    protected $table = 'keyword_edu_bgs';
}
