<?php

namespace App\Database\Models;

use App\Database\Model;
use App\Database\Models\Activity;
use App\Database\Models\CardGroup;
use App\Database\Models\Match;
use App\Database\Models\User;

class Card extends Model {

    protected $table   = 'cards';
    protected $casts = [
        'id' => 'integer',
        'chooser_id' => 'integer',
        'showner_id' => 'integer',
        'match_id' => 'integer',
        'group_id' => 'integer'
    ];
    protected $visible = [
        self::ID,
        self::CHOOSER_ID,
        self::SHOWNER_ID,
        self::MATCH_ID,
        self::GROUP_ID,
        self::UPDATED_AT,
        self::CREATED_AT
    ];
    public $timestamps = true;

    const ID         = 'id';
    const ACTIVITIES = 'activities';
    const CHOOSER    = 'chooser';
    const CHOOSER_ID = 'chooser_id';
    const SHOWNER    = 'showner';
    const SHOWNER_ID = 'showner_id';
    const GROUP      = 'group';
    const GROUP_ID   = 'group_id';
    const MATCH      = 'match';
    const MATCH_ID   = 'match_id';
    const CREATED_AT = 'created_at';

    public function activityQuery()
    {
        return inst(Activity::class)->aliasQuery()
            ->qWhere(Activity::RELATED_ID, $this->{static::ID});
    }

    public function chooserQuery()
    {
        return inst(User::class)->aliasQuery()
            ->qWhere(User::ID, $this->{static::CHOOSER_ID});
    }

    public function groupQuery()
    {
        return inst(CardGroup::class)->aliasQuery()
            ->qWhere(CardGroup::ID, $this->{static::GROUP_ID});
    }

    public function matchQuery()
    {
        return inst(Match::class)->aliasQuery()
            ->qWhere(Match::ID, $this->{static::MATCH_ID});
    }

    public function shownerQuery()
    {
        return inst(User::class)->aliasQuery()
            ->qWhere(User::ID, $this->{static::SHOWNER_ID});
    }

}
