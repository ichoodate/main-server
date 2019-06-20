<?php

namespace App\Database\Models;

use App\Database\Model;
use App\Database\Models\User;

class Popularity extends Model {

    protected $table = 'popularities';
    protected $casts = [
        self::ID => 'integer',
        self::SENDER_ID => 'integer',
        self::RECEIVER_ID => 'integer',
        self::POINT => 'integer'
    ];
    protected $fillable = [
        self::ID,
        self::SENDER_ID,
        self::RECEIVER_ID,
        self::POINT,
        self::CREATED_AT
    ];

    const ID          = 'id';
    const SENDER_ID   = 'sender_id';
    const RECEIVER_ID = 'receiver_id';
    const POINT       = 'point';
    const CREATED_AT  = 'created_at';

    public function getExpandable()
    {
        return ['receiver', 'sender'];
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id', 'id');
    }

    public function receiverQuery()
    {
        return inst(User::class)->query()
            ->qWhere(User::ID, $this->{static::RECEIVER_ID});
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id', 'id');
    }

    public function senderQuery()
    {
        return inst(User::class)->query()
            ->qWhere(User::ID, $this->{static::SENDER_ID});
    }

}
