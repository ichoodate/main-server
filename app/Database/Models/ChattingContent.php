<?php

namespace App\Database\Models;

use App\Database\Model;
use App\Database\Models\Match;
use App\Database\Models\User;

class ChattingContent extends Model {

    protected $table = 'chatting_contents';
    protected $casts = [
        self::ID => 'integer',
        self::WRITER_ID => 'integer'
    ];
    protected $fillable = [
        self::ID,
        self::MATCH_ID,
        self::WRITER_ID,
        self::MESSAGE,
        self::CREATED_AT
    ];

    const ID         = 'id';
    const MATCH      = 'match';
    const MATCH_ID   = 'match_id';
    const WRITER     = 'writer';
    const WRITER_ID  = 'writer_id';
    const MESSAGE    = 'message';
    const CREATED_AT = 'created_at';

    public function getExpandable()
    {
        return ['match', 'writer'];
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

    public function writer()
    {
        return $this->belongsTo(User::class, 'writer_id', 'id');
    }

    public function writerQuery()
    {
        return inst(User::class)->query()
            ->qWhere(User::ID, $this->{static::WRITER_ID});
    }

}
