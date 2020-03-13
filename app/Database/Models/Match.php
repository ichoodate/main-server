<?php

namespace App\Database\Models;

use App\Database\Model;
use App\Database\Models\Card;
use App\Database\Models\Friend;
use App\Database\Models\User;

class Match extends Model {

    protected $table = 'matches';
    protected $casts = [
        self::ID => 'integer',
        self::MAN_ID => 'integer',
        self::WOMAN_ID => 'integer'
    ];
    protected $fillable = [
        self::ID,
        self::MAN_ID,
        self::WOMAN_ID
    ];

    const ID       = 'id';
    const FRIENDS  = 'friends';
    const MAN      = 'man';
    const MAN_ID   = 'man_id';
    const WOMAN    = 'woman';
    const WOMAN_ID = 'woman_id';
    const CARDS    = 'cards';

    public function getExpandable()
    {
        return ['friends', 'man', 'woman', 'cards'];
    }

    public function friends()
    {
        return $this->hasMany(Friend::class, 'match_id', 'id');
    }

    public function friendQuery()
    {
        return inst(Friend::class)->query()
            ->qWhere(Friend::RELATED_ID, $this->{static::ID});
    }

    public function cards()
    {
        return $this->hasMany(Card::class, 'match_id', 'id');
    }

    public function cardQuery()
    {
        return inst(Card::class)->query()
            ->qWhere(Card::MATCH_ID, $this->{static::ID});
    }

    public function chattingContents()
    {
        return $this->hasMany(ChattingContent::class, 'match_id', 'id');
    }

    public function chattingContentQuery()
    {
        return inst(ChattingContent::class)->query()
            ->qWhere(ChattingContent::MATCH_ID, $this->{static::ID});
    }

    public function man()
    {
        return $this->belongsTo(User::class, 'man_id', 'id');
    }

    public function manQuery()
    {
        return inst(User::class)->query()
            ->qWhere(User::ID, $this->{static::MAN_ID});
    }

    public function woman()
    {
        return $this->belongsTo(User::class, 'woman_id', 'id');
    }

    public function womanQuery()
    {
        return inst(User::class)->query()
            ->qWhere(User::ID, $this->{static::WOMAN_ID});
    }

}
