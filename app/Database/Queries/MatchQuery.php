<?php

namespace App\Database\Queries;

use App\Database\Models\Card;
use App\Database\Models\ChattingContent;
use App\Database\Models\Friend;
use App\Database\Models\Match;
use App\Database\Models\User;
use App\Database\Query;

class MatchQuery extends Query {

    public function cardQuery()
    {
        $subQuery = $this->qSelect(Match::ID)->getQuery();

        return inst(Card::class)->query()
            ->qWhereIn(Card::MATCH_ID, $subQuery);
    }

    public function chattingContentQuery()
    {
        $subQuery = $this->qSelect(Match::ID)->getQuery();

        return inst(ChattingContent::class)->query()
            ->qWhereIn(ChattingContent::MATCH_ID, $subQuery);
    }

    public function friendQuery()
    {
        $subQuery = $this->qSelect(Match::ID)->getQuery();

        return inst(Friend::class)->query()
            ->qWhereIn(Friend::MATCH_ID, $subQuery);
    }

    public function manQuery()
    {
        $subQuery = $this->qSelect(Match::MAN_ID)->getQuery();

        return inst(User::class)->query()
            ->qWhereIn(User::ID, $subQuery);
    }

    public function womanQuery()
    {
        $subQuery = $this->qSelect(Match::WOMAN_ID)->getQuery();

        return inst(User::class)->query()
            ->qWhereIn(User::ID, $subQuery);
    }

}
