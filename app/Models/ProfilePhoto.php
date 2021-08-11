<?php

namespace App\Models;

use App\Model;

class ProfilePhoto extends Model
{
    public const ID = 'id';
    public const USER_ID = 'user_id';
    public const DATA = 'data';
    public const CREATED_AT = 'created_at';

    protected $table = 'profile_photos';
    protected $casts = [
        self::ID => 'integer',
        self::USER_ID => 'integer',
    ];
    protected $fillable = [
        self::ID,
        self::USER_ID,
        self::DATA,
        self::CREATED_AT,
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
