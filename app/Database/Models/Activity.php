<?php

namespace App\Database\Models;

use App\Database\Model;
use App\Database\Models\Notification;
use App\Database\Models\User;

class Activity extends Model {

    protected $table = 'activities';
    protected $visible = [
        self::ID,
        self::RELATED_ID,
        self::USER_ID,
        self::TYPE,
        self::CREATED_AT
    ];

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

    public function relatedQuery()
    {
        return inst(Obj::class)->aliasQuery()
            ->qWhere(Obj::ID, $this->{static::RELATED_ID});
    }

    public function userQuery()
    {
        return inst(User::class)->aliasQuery()
            ->qWhere(User::ID, $this->{static::USER_ID});
    }

}
