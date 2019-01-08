<?php

namespace App\Database\Models;

use App\Database\Model;

class EduBg extends Model {

    protected $table = 'keyword_edu_backgrounds';
    protected $visible = [
        self::ID,
        self::TYPE
    ];

    const TYPE = 'type';

    const TYPE_PRIMARY_SCHOOL   = 'primary_school';
    const TYPE_SECONDARY_SCHOOL = 'secondary_school';
    const TYPE_HIGH_SCHOOL      = 'high_school';
    const TYPE_COLLEGE          = 'college';
    const TYPE_UNIVERSITY       = 'university';

    const TYPE_VALUES = [
        self::TYPE_PRIMARY_SCHOOL,
        self::TYPE_SECONDARY_SCHOOL,
        self::TYPE_HIGH_SCHOOL,
        self::TYPE_COLLEGE,
        self::TYPE_UNIVERSITY
    ];

}
