<?php

namespace App\Database\Models;

use App\Database\Model;

class PwdReset extends Model {

    protected $table = 'password_resets';
    protected $casts = [];
    protected $fillable = [
        self::ID,
        self::EMAIL,
        self::TOKEN,
        self::COMPLETE,
        self::CREATED_AT,
        self::UPDATED_AT
    ];

    const ID         = 'id';
    const EMAIL      = 'email';
    const TOKEN      = 'token';
    const COMPLETE   = 'complete';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public function getExpandable()
    {
        return [];
    }

}
