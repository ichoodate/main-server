<?php

namespace App\Database\Models\Keyword;

use App\Database\Model;

class Hobby extends Model {

    protected $table = 'keyword_hobbies';
    protected $fillable = [
        self::ID,
        self::TYPE
    ];

    const ID   = 'id';
    const TYPE = 'type';

    const TYPE_VALUES = [
        'hobby1',
        'hobby2',
        'hobby3',
        'hobby4',
        'hobby5'
    ];

    public function getExpandable()
    {
        return [];
    }

}
