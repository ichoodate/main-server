<?php

namespace App\Database\Queries;

use App\Database\Models\Card;
use App\Database\Models\CardFlip;
use App\Database\Models\CardGroup;
use App\Database\Models\Match;
use App\Database\Models\User;
use App\Database\Query;

class CardQuery extends Query {

    public function flipQuery()
    {
        $subQuery = $this->qSelect(Card::ID)->getQuery();

        return inst(CardFlip::class)->query()
            ->qWhereIn(CardFlip::CARD_ID, $subQuery);
    }

    public function chooserQuery()
    {
        $subQuery = $this->qSelect(Card::CHOOSER_ID)->getQuery();

        return inst(User::class)->query()
            ->qWhereIn(User::ID, $subQuery);
    }

    public function groupQuery()
    {
        $subQuery = $this->qSelect(Card::GROUP_ID)->getQuery();

        return inst(CardGroup::class)->query()
            ->qWhereIn(CardGroup::ID, $subQuery);
    }

    public function matchQuery()
    {
        $subQuery = $this->qSelect(Card::MATCH_ID)->getQuery();

        return inst(Match::class)->query()
            ->qWhereIn(Match::ID, $subQuery);
    }

    public function shownerQuery()
    {
        $subQuery = $this->qSelect(Card::SHOWNER_ID)->getQuery();

        return inst(User::class)->query()
            ->qWhereIn(User::ID, $subQuery);
    }

}
