<?php

namespace App\Models;

use App\Model;

class ChattingContent extends Model
{
    public const CREATED_AT = 'created_at';
    public const ID = 'id';
    public const IS_READ = 'is_read';
    public const MATCH = 'match';
    public const MATCH_ID = 'match_id';
    public const MESSAGE = 'message';
    public const WRITER = 'writer';
    public const WRITER_ID = 'writer_id';
    protected $casts = [
        self::ID => 'integer',
        self::WRITER_ID => 'integer',
        self::CREATED_AT => 'datetime',
    ];
    protected $fillable = [
        self::ID,
        self::MATCH_ID,
        self::WRITER_ID,
        self::MESSAGE,
        self::IS_READ,
        self::CREATED_AT,
    ];

    protected $table = 'chatting_contents';

    public function match()
    {
        return $this->belongsTo(Matching::class, 'match_id', 'id');
    }

    public function writer()
    {
        return $this->belongsTo(User::class, 'writer_id', 'id');
    }
}
