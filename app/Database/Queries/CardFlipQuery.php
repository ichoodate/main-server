<?php

namespace App\Database\Queries;

use App\Database\Models\Card;
use App\Database\Models\CardFlip;
use App\Database\Models\Notification;
use App\Database\Models\User;
use App\Database\Query;

class CardFlipQuery extends Query {

    public function cardQuery()
    {
        $subQuery = $this->qSelect(CardFlip::CARD_ID)->getQuery();

        return inst(Card::class)->query()
            ->qWhereIn(Card::ID, $subQuery);
    }

    public function userQuery()
    {
        $subQuery = $this->qSelect(CardFlip::USER_ID)->getQuery();

        return inst(User::class)->query()
            ->qWhereIn(User::ID, $subQuery);
    }

}
