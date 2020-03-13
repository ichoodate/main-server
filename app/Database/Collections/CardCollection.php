<?php

namespace App\Database\Collections;

use App\Database\Models\CardFlip;
use App\Database\Models\Card;
use App\Database\Models\Match;
use App\Database\Collection;

class CardCollection extends Collection {

    public function cardFlipQuery()
    {
        $cardIds = $this->pluck(Card::ID)->all();

        return inst(CardFlip::class)->query()->qWhereIn(CardFlip::CARD_ID, $cardIds);
    }

    public function matchQuery()
    {
        $matchIds = $this->pluck(Card::MATCH_ID)->all();

        return inst(Match::class)->query()->qWhereIn(Match::ID, $matchIds);
    }

}
