<?php

namespace App\Models;

use App\Model;

class Card extends Model
{
    public const CHOOSER = 'chooser';
    public const CHOOSER_ID = 'chooser_id';
    public const CREATED_AT = 'created_at';
    public const FLIPS = 'flips';
    public const GROUP = 'group';
    public const GROUP_ID = 'group_id';
    public const ID = 'id';
    public const MATCH = 'match';
    public const MATCH_ID = 'match_id';
    public const SHOWNER = 'showner';
    public const SHOWNER_ID = 'showner_id';
    public const UPDATED_AT = 'updated_at';
    protected $casts = [
        self::ID => 'integer',
        self::CHOOSER_ID => 'integer',
        self::SHOWNER_ID => 'integer',
        self::MATCH_ID => 'integer',
        self::GROUP_ID => 'integer',
    ];
    protected $fillable = [
        self::ID,
        self::CHOOSER_ID,
        self::SHOWNER_ID,
        self::MATCH_ID,
        self::GROUP_ID,
        self::UPDATED_AT,
        self::CREATED_AT,
    ];

    protected $table = 'cards';

    public function chooser()
    {
        return $this->belongsTo(User::class, 'chooser_id', 'id');
    }

    public function flips()
    {
        return $this->hasMany(CardFlip::class, 'card_id', 'id');
    }

    public function group()
    {
        return $this->belongsTo(CardGroup::class, 'group_id', 'id');
    }

    public function match()
    {
        return $this->belongsTo(Matching::class, 'match_id', 'id');
    }

    public function showner()
    {
        return $this->belongsTo(User::class, 'showner_id', 'id');
    }
}
