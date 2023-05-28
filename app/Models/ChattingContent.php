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
    public const RECEIVER = 'receiver';
    public const RECEIVER_ID = 'receiver_id';
    public const SENDER = 'sender';
    public const SENDER_ID = 'sender_id';

    protected $casts = [
        self::ID => 'integer',
        self::SENDER_ID => 'integer',
        self::CREATED_AT => 'datetime',
    ];
    protected $fillable = [
        self::ID,
        self::MATCH_ID,
        self::SENDER_ID,
        self::MESSAGE,
        self::IS_READ,
        self::CREATED_AT,
    ];

    protected $table = 'chatting_contents';

    public function match()
    {
        return $this->belongsTo(Matching::class, 'match_id', 'id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id', 'id');
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id', 'id');
    }
}
