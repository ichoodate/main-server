<?php

namespace App\Database\Models;

use App\Database\Model;
use App\Database\Models\Notification;
use App\Database\Models\User;

class Activity extends Model {

    protected $table = 'activities';
    protected $casts = [
        self::ID => 'integer',
        self::USER_ID => 'integer',
        self::RELATED_ID => 'integer'
    ];
    protected $fillable = [
        self::ID,
        self::USER_ID,
        self::RELATED_ID,
        self::TYPE,
        self::CREATED_AT
    ];

    const ID         = 'id';
    const RELATED    = 'related';
    const RELATED_ID = 'related_id';
    const USER       = 'user';
    const USER_ID    = 'user_id';
    const TYPE       = 'type';
    const CREATED_AT = 'created_at';

    const TYPE_CARD_FLIP           = 'card_flip';
    const TYPE_CARD_OPEN           = 'card_open';
    const TYPE_CARD_PROPOSE        = 'card_propose';
    const TYPE_MATCH_OPEN          = 'match_open';
    const TYPE_MATCH_PROPOSE       = 'match_propose';
    const TYPE_CHATTING_ROOM_BLOCK = 'chatting_room_block';

    const TYPE_VALUES = [
        self::TYPE_CARD_FLIP,
        self::TYPE_CARD_OPEN,
        self::TYPE_CARD_PROPOSE,
        self::TYPE_MATCH_OPEN,
        self::TYPE_MATCH_PROPOSE,
        self::TYPE_CHATTING_ROOM_BLOCK
    ];

    public function getExpandable()
    {
        return ['user', 'related.concrete'];
    }

    public function related()
    {
        return $this->belongsTo(Obj::class, 'related_id', 'id');
    }

    public function relatedQuery()
    {
        return inst(Obj::class)->query()
            ->qWhere(Obj::ID, $this->{static::RELATED_ID});
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function userQuery()
    {
        return inst(User::class)->query()
            ->qWhere(User::ID, $this->{static::USER_ID});
    }

}
