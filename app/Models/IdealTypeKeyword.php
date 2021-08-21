<?php

namespace App\Models;

use App\Model;

class IdealTypeKeyword extends Model
{
    public const ID = 'id';
    public const KEYWORD_ID = 'keyword_id';
    public const USER_ID = 'user_id';
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

    protected $table = 'ideal_type_keywords';

    public function keywordObj()
    {
        return $this->belongsTo(Obj::class, 'keyword_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
