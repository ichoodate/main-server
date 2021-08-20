<?php

namespace App\Models;

use App\Model;

class Friend extends Model
{
    public const CREATED_AT = 'created_at';
    public const ID = 'id';
    public const MATCH_ID = 'match_id';
    public const RECEIVER_ID = 'receiver_id';
    public const SENDER_ID = 'sender_id';
    protected $casts = [
        self::ID => 'integer',
        self::SENDER_ID => 'integer',
        self::RECEIVER_ID => 'integer',
        self::MATCH_ID => 'integer',
    ];
    protected $fillable = [
        self::ID,
        self::SENDER_ID,
        self::RECEIVER_ID,
        self::MATCH_ID,
        self::CREATED_AT,
    ];

    protected $table = 'friends';

    public function match()
    {
        return $this->belongsTo(Match::class, 'match_id', 'id');
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
