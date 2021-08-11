<?php

namespace App\Models;

use App\Model;

class Match extends Model
{
    public const ID = 'id';
    public const CARDS = 'cards';
    public const FRIENDS = 'friends';
    public const MAN = 'man';
    public const MAN_ID = 'man_id';
    public const WOMAN = 'woman';
    public const WOMAN_ID = 'woman_id';

    protected $table = 'matches';
    protected $casts = [
        self::ID => 'integer',
        self::MAN_ID => 'integer',
        self::WOMAN_ID => 'integer',
    ];
    protected $fillable = [
        self::ID,
        self::MAN_ID,
        self::WOMAN_ID,
    ];

    public function cards()
    {
        return $this->hasMany(Card::class, 'match_id', 'id');
    }

    public function friends()
    {
        return $this->hasMany(Friend::class, 'match_id', 'id');
    }

    public function man()
    {
        return $this->belongsTo(User::class, 'man_id', 'id');
    }

    public function user()
    {
        if (auth()->user() && User::GENDER_MAN == auth()->user()->{User::GENDER}) {
            return $this->woman();
        }
        if (auth()->user() && User::GENDER_WOMAN == auth()->user()->{User::GENDER}) {
            return $this->man();
        }
    }

    public function woman()
    {
        return $this->belongsTo(User::class, 'woman_id', 'id');
    }
}
