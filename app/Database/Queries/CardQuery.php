<?php

namespace App\Database\Queries;

use App\Database\Models\Activity;
use App\Database\Models\Card;
use App\Database\Models\CardGroup;
use App\Database\Models\Match;
use App\Database\Models\User;
use App\Database\Query;

class CardQuery extends Query {

    public function activityQuery()
    {
        $subQuery = $this->qSelect(Card::ID)->getQuery();

        return inst(Activity::class)->aliasQuery()
            ->qWhereIn(Activity::RELATED_ID, $subQuery);
    }

    public function chooserQuery()
    {
        $subQuery = $this->qSelect(Card::CHOOSER_ID)->getQuery();

        return inst(User::class)->aliasQuery()
            ->qWhereIn(User::ID, $subQuery);
    }

    public function groupQuery()
    {
        $subQuery = $this->qSelect(Card::GROUP_ID)->getQuery();

        return inst(CardGroup::class)->aliasQuery()
            ->qWhereIn(CardGroup::ID, $subQuery);
    }

    public function matchQuery()
    {
        $subQuery = $this->qSelect(Card::MATCH_ID)->getQuery();

        return inst(Match::class)->aliasQuery()
            ->qWhereIn(Match::ID, $subQuery);
    }

    public function shownerQuery()
    {
        $subQuery = $this->qSelect(Card::SHOWNER_ID)->getQuery();

        return inst(User::class)->aliasQuery()
            ->qWhereIn(User::ID, $subQuery);
    }

}
