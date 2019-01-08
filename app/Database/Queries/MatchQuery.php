<?php

namespace App\Database\Queries;

use App\Database\Models\Activity;
use App\Database\Models\Card;
use App\Database\Models\ChattingRoom;
use App\Database\Models\Match;
use App\Database\Models\User;
use App\Database\Query;

class MatchQuery extends Query {

    public function activityQuery()
    {
        $subQuery = $this->qSelect(Match::ID)->getQuery();

        return inst(Activity::class)->aliasQuery()
            ->qWhereIn(Activity::RELATED_ID, $subQuery);
    }

    public function cardQuery()
    {
        $subQuery = $this->qSelect(Match::ID)->getQuery();

        return inst(Card::class)->aliasQuery()
            ->qWhereIn(Card::MATCH_ID, $subQuery);
    }

    public function manQuery()
    {
        $subQuery = $this->qSelect(Match::MAN_ID)->getQuery();

        return inst(User::class)->aliasQuery()
            ->qWhereIn(User::ID, $subQuery);
    }

    public function womanQuery()
    {
        $subQuery = $this->qSelect(Match::WOMAN_ID)->getQuery();

        return inst(User::class)->aliasQuery()
            ->qWhereIn(User::ID, $subQuery);
    }

}
