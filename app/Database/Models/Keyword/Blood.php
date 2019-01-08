<?php

namespace App\Database\Models;

use App\Database\Model;

class Blood extends Model {

    protected $table = 'keyword_bloods';
    protected $visible = [
        self::ID,
        self::TYPE
    ];

    const TYPE = 'type';

    const TYPE_A  = 'A';
    const TYPE_B  = 'B';
    const TYPE_O  = 'O';
    const TYPE_AB = 'AB';

    const TYPE_VALUES = [
        self::TYPE_A,
        self::TYPE_B,
        self::TYPE_O,
        self::TYPE_AB
    ];

}
