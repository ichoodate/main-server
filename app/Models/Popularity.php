<?php

namespace App\Database\Models;

use App\Database\Model;

class Popularity extends Model
{
    public const ID = 'id';
    public const SENDER_ID = 'sender_id';
    public const RECEIVER_ID = 'receiver_id';
    public const POINT = 'point';
    public const CREATED_AT = 'created_at';

    protected $table = 'popularities';
    protected $casts = [
        self::ID => 'integer',
        self::SENDER_ID => 'integer',
        self::RECEIVER_ID => 'integer',
        self::POINT => 'integer',
    ];
    protected $fillable = [
        self::ID,
        self::SENDER_ID,
        self::RECEIVER_ID,
        self::POINT,
        self::CREATED_AT,
    ];

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id', 'id');
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id', 'id');
    }
}
