<?php

namespace App\Database\Models;

use App\Database\Model;
use App\Database\Models\CardFlip;
use App\Database\Models\CardGroup;
use App\Database\Models\Match;
use App\Database\Models\User;

class Card extends Model {

    protected $table   = 'cards';
    protected $casts = [
        self::ID => 'integer',
        self::CHOOSER_ID => 'integer',
        self::SHOWNER_ID => 'integer',
        self::MATCH_ID => 'integer',
        self::GROUP_ID => 'integer'
    ];
    protected $fillable = [
        self::ID,
        self::CHOOSER_ID,
        self::SHOWNER_ID,
        self::MATCH_ID,
        self::GROUP_ID,
        self::UPDATED_AT,
        self::CREATED_AT
    ];

    const ID         = 'id';
    const CREATED_AT = 'created_at';
    const CHOOSER    = 'chooser';
    const CHOOSER_ID = 'chooser_id';
    const FLIPS      = 'flips';
    const GROUP      = 'group';
    const GROUP_ID   = 'group_id';
    const MATCH      = 'match';
    const MATCH_ID   = 'match_id';
    const SHOWNER    = 'showner';
    const SHOWNER_ID = 'showner_id';
    const UPDATED_AT = 'updated_at';

    public function getExpandable()
    {
        return ['flips', 'chooser', 'chooser.facePhoto', 'group', 'match', 'match.following', 'showner', 'showner.facePhoto'];
    }

    public function flips()
    {
        return $this->hasMany(CardFlip::class, 'card_id', 'id');
    }

    public function flipQuery()
    {
        return inst(CardFlip::class)->query()
            ->qWhere(CardFlip::CARD_ID, $this->{static::ID});
    }

    public function chooser()
    {
        return $this->belongsTo(User::class, 'chooser_id', 'id');
    }

    public function chooserQuery()
    {
        return inst(User::class)->query()
            ->qWhere(User::ID, $this->{static::CHOOSER_ID});
    }

    public function group()
    {
        return $this->belongsTo(CardGroup::class, 'group_id', 'id');
    }

    public function groupQuery()
    {
        return inst(CardGroup::class)->query()
            ->qWhere(CardGroup::ID, $this->{static::GROUP_ID});
    }

    public function match()
    {
        return $this->belongsTo(Match::class, 'match_id', 'id');
    }

    public function matchQuery()
    {
        return inst(Match::class)->query()
            ->qWhere(Match::ID, $this->{static::MATCH_ID});
    }

    public function showner()
    {
        return $this->belongsTo(User::class, 'showner_id', 'id');
    }

    public function shownerQuery()
    {
        return inst(User::class)->query()
            ->qWhere(User::ID, $this->{static::SHOWNER_ID});
    }

}
