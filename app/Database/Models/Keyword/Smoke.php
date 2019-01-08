<?php

namespace App\Database\Models;

use App\Database\Model;

class Smoke extends Model {

    protected $table = 'keyword_smokes';
    protected $visible = [
        self::ID,
        self::TYPE
    ];

    const TYPE = 'type';

    const ENTITIES = [
        self::ID,
        self::TYPE
    ];

    const TYPE_VALUES = [
        'smoker',
        'non_smoker'
    ];

}
