<?php

namespace App\Database\Collections;

use App\Database\Models\Activity;
use App\Database\Models\Card;
use App\Database\Models\Match;
use App\Database\Collection;

class CardCollection extends Collection {

    public function activityQuery()
    {
        $cardIds = $this->pluck(Card::ID)->all();

        return inst(Activity::class)->aliasQuery()->qWhereIn(Activity::RELATED_ID, $cardIds);
    }

    public function matchQuery()
    {
        $matchIds = $this->pluck(Card::MATCH_ID)->all();

        return inst(Match::class)->aliasQuery()->qWhereIn(Match::ID, $matchIds);
    }

}
