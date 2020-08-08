<?php

namespace App\Database\Models;

use App\Database\Model;
use App\Database\Models\Match;
use App\Database\Models\User;

class Friend extends Model {

    protected $table = 'friends';
    protected $casts = [
        self::ID => 'integer',
        self::SENDER_ID => 'integer',
        self::RECEIVER_ID => 'integer',
        self::MATCH_ID => 'integer'
    ];
    protected $fillable = [
        self::ID,
        self::SENDER_ID,
        self::RECEIVER_ID,
        self::MATCH_ID,
        self::CREATED_AT
    ];

    const ID          = 'id';
    const SENDER_ID   = 'sender_id';
    const RECEIVER_ID = 'receiver_id';
    const MATCH_ID    = 'match_id';
    const CREATED_AT  = 'created_at';

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id', 'id');
    }

    public function match()
    {
        return $this->belongsTo(Match::class, 'match_id', 'id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id', 'id');
    }

}
