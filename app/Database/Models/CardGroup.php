<?php

namespace App\Database\Models;

use App\Database\Model;
use App\Database\Models\Card;
use App\Database\Models\User;

class CardGroup extends Model {

    protected $table = 'card_groups';
    protected $visible = [
        self::ID,
        self::USER_ID,
        self::TYPE,
        self::CREATED_AT
    ];

    const CARDS      = 'cards';
    const USER       = 'user';
    const USER_ID    = 'user_id';
    const TYPE       = 'type';
    const CREATED_AT = 'created_at';

    const TYPE_DAILY = 'daily';
    const TYPE_VALUES = [
        self::TYPE_DAILY
    ];

    public function cardQuery()
    {
        return inst(Card::class)->aliasQuery()
            ->qWhere(Card::GROUP_ID, $this->{static::ID});
    }

    public function userQuery()
    {
        return inst(User::class)->aliasQuery()
            ->qWhere(User::ID, $this->{static::USER_ID});
    }

}
