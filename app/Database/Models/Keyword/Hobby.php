<?php

namespace App\Database\Models;

use App\Database\Model;

class Hobby extends Model {

    protected $table = 'keyword_hobbies';
    protected $visible = [
        self::ID,
        self::TYPE
    ];

    const TYPE   = 'type';

    const TYPE_VALUES = [
        'hobby1',
        'hobby2',
        'hobby3',
        'hobby4',
        'hobby5'
    ];

}
