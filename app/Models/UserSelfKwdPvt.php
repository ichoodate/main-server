<?php

namespace App\Database\Models;

use App\Database\Model;

class UserSelfKwdPvt extends Model
{
    public const ID = 'id';
    public const USER_ID = 'user_id';
    public const KEYWORD_ID = 'keyword_id';

    protected $table = 'user_self_kwd_pvts';
    protected $casts = [
        self::ID => 'integer',
        self::USER_ID => 'integer',
        self::KEYWORD_ID => 'integer',
    ];
    protected $fillable = [
        self::ID,
        self::USER_ID,
        self::KEYWORD_ID,
    ];

    public function keyword()
    {
        return $this->belongsTo(Obj::class, 'keyword_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
