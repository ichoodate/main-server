<?php

namespace App\Database\Models;

use App\Database\Model;
use App\Database\Models\Match;
use App\Database\Models\User;

class ChattingContent extends Model {

    protected $table = 'chatting_contents';
    protected $visible = [
        self::ID,
        self::MATCH_ID,
        self::WRITER_ID,
        self::MESSAGE,
        self::CREATED_AT
    ];

    const MATCH      = 'match';
    const MATCH_ID   = 'match_id';
    const WRITER     = 'writer';
    const WRITER_ID  = 'writer_id';
    const MESSAGE    = 'message';
    const CREATED_AT = 'created_at';

    public function matchQuery()
    {
        return inst(Match::class)->aliasQuery()
            ->qWhere(Match::ID, $this->{static::MATCH_ID});
    }

    public function writerQuery()
    {
        return inst(User::class)->aliasQuery()
            ->qWhere(User::ID, $this->{static::WRITER_ID});
    }

}
