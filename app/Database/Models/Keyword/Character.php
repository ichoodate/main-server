<?php

namespace App\Database\Models;

use App\Database\Model;

class Character extends Model {

    protected $table = 'keyword_characters';
    protected $visible = [
        self::ID,
        self::TYPE
    ];

    const TYPE   = 'type';

    const TYPE_VALUES = [
        'character1',
        'character2',
        'character3',
        'character4',
        'character5'
    ];

}
