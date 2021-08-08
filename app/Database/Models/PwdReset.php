<?php

namespace App\Database\Models;

use App\Database\Model;

class PwdReset extends Model
{
    public const ID = 'id';
    public const EMAIL = 'email';
    public const TOKEN = 'token';
    public const COMPLETE = 'complete';
    public const CREATED_AT = 'created_at';
    public const UPDATED_AT = 'updated_at';

    protected $table = 'password_resets';
    protected $casts = [];
    protected $fillable = [
        self::ID,
        self::EMAIL,
        self::TOKEN,
        self::COMPLETE,
        self::CREATED_AT,
        self::UPDATED_AT,
    ];
}
