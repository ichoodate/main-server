<?php

namespace App\Database\Models;

use App\Database\Model;

class ChattingContent extends Model
{
    public const ID = 'id';
    public const MATCH = 'match';
    public const MATCH_ID = 'match_id';
    public const WRITER = 'writer';
    public const WRITER_ID = 'writer_id';
    public const MESSAGE = 'message';
    public const CREATED_AT = 'created_at';

    protected $table = 'chatting_contents';
    protected $casts = [
        self::ID => 'integer',
        self::WRITER_ID => 'integer',
    ];
    protected $fillable = [
        self::ID,
        self::MATCH_ID,
        self::WRITER_ID,
        self::MESSAGE,
        self::CREATED_AT,
    ];

    public function match()
    {
        return $this->belongsTo(Match::class, 'match_id', 'id');
    }

    public function writer()
    {
        return $this->belongsTo(User::class, 'writer_id', 'id');
    }
}
