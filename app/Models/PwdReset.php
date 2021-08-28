<?php

namespace App\Models;

use App\Model;

class PwdReset extends Model
{
    public const COMPLETE = 'complete';
    public const CREATED_AT = 'created_at';
    public const EMAIL = 'email';
    public const ID = 'id';
    public const TOKEN = 'token';
    public const UPDATED_AT = 'updated_at';
    protected $casts = [
        self::ID => 'integer',
        self::COMPLETE => 'boolean',
    ];
    protected $fillable = [
        self::ID,
        self::EMAIL,
        self::TOKEN,
        self::COMPLETE,
        self::CREATED_AT,
        self::UPDATED_AT,
    ];

    protected $table = 'password_resets';
}
