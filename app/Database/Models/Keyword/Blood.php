<?php

namespace App\Database\Models\Keyword;

use App\Database\Model;

class Blood extends Model {

    protected $table = 'keyword_bloods';
    protected $fillable = [
        self::ID,
        self::TYPE
    ];

    const ID   = 'id';
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

    public function getExpandable()
    {
        return [];
    }

}
