<?php

namespace App\Database\Models;

use App\Database\Model;
use App\Database\Models\Obj;

class MatchingKwdPvt extends Model {

    protected $table = 'matching_keyword_pivots';
    protected $casts = [
        self::ID                => 'integer',
        self::IDEAL_TYPE_KWD_ID => 'integer',
        self::MATCHING_KWD_ID   => 'integer'
    ];
    protected $fillable = [
        self::ID,
        self::IDEAL_TYPE_KWD_ID,
        self::MATCHING_KWD_ID
    ];

    const ID                = 'id';
    const IDEAL_TYPE_KWD_ID = 'ideal_type_kwd_id';
    const MATCHING_KWD_ID   = 'matching_kwd_id';

    public function getExpandable()
    {
        return ['idealTypeKeywords', 'matchingKeywords'];
    }

    public function idealTypeKeywords()
    {
        return $this->belongsTo(Obj::class, 'ideal_kwd_id', 'id');
    }

    public function idealTypeKeywordQuery()
    {
        return inst(Obj::class)->query()
            ->qWhere(Obj::ID, $this->{static::IDEAL_TYPE_KWD_ID});
    }

    public function matchingKeywords()
    {
        return $this->belongsTo(Obj::class, 'self_kwd_id', 'id');
    }

    public function matchingKeywordQuery()
    {
        return inst(Obj::class)->query()
            ->qWhere(Obj::ID, $this->{static::MATCHING_KWD_ID});
    }

}
