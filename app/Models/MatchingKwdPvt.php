<?php

namespace App\Models;

use App\Model;

class MatchingKwdPvt extends Model
{
    public const ID = 'id';
    public const IDEAL_TYPE_KWD_ID = 'ideal_type_kwd_id';
    public const MATCHING_KWD_ID = 'matching_kwd_id';

    protected $table = 'matching_keyword_pivots';
    protected $casts = [
        self::ID => 'integer',
        self::IDEAL_TYPE_KWD_ID => 'integer',
        self::MATCHING_KWD_ID => 'integer',
    ];
    protected $fillable = [
        self::ID,
        self::IDEAL_TYPE_KWD_ID,
        self::MATCHING_KWD_ID,
    ];

    public function idealTypeKeywords()
    {
        return $this->belongsTo(Obj::class, 'ideal_kwd_id', 'id');
    }

    public function matchingKeywords()
    {
        return $this->belongsTo(Obj::class, 'self_kwd_id', 'id');
    }
}
