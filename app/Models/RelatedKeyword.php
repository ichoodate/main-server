<?php

namespace App\Models;

use App\Model;

class RelatedKeyword extends Model
{
    public const ID = 'id';
    public const KEYWORD_ID = 'keyword_id';
    public const RELATED_ID = 'related_id';
    protected $casts = [
        self::ID => 'integer',
        self::KEYWORD_ID => 'integer',
        self::RELATED_ID => 'integer',
    ];
    protected $fillable = [
        self::ID,
        self::KEYWORD_ID,
        self::RELATED_ID,
    ];

    protected $table = 'related_keywords';

    public function keywordObj()
    {
        return $this->belongsTo(Obj::class, 'keyword_id', 'id');
    }

    public function relatedObj()
    {
        return $this->belongsTo(Obj::class, 'related_id', 'id');
    }
}
