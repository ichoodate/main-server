<?php

namespace App\Database\Models;

use App\Database\Model;
use App\Database\Models\Activity;
use App\Database\Models\User;

class Match extends Model {

    protected $table = 'matches';
    protected $casts = [
        'id' => 'integer',
        'man_id' => 'integer',
        'woman_id' => 'integer'
    ];
    protected $visible = [
        self::ID,
        self::MAN_ID,
        self::WOMAN_ID
    ];

    const ACTIVITIES = 'activities';
    const MAN        = 'man';
    const MAN_ID     = 'man_id';
    const WOMAN      = 'woman';
    const WOMAN_ID   = 'woman_id';
    const CARDS      = 'cards';


    public function activityQuery()
    {
        return inst(Activity::class)->aliasQuery()
            ->qWhere(Activity::RELATED_ID, $this->{static::ID});
    }

    public function cardQuery()
    {
        return inst(Card::class)->aliasQuery()
            ->qWhere(Card::MATCH_ID, $this->{static::ID});
    }

    public function manQuery()
    {
        return inst(User::class)->aliasQuery()
            ->qWhere(User::ID, $this->{static::MAN_ID});
    }

    public function womanQuery()
    {
        return inst(User::class)->aliasQuery()
            ->qWhere(User::ID, $this->{static::WOMAN_ID});
    }

}
