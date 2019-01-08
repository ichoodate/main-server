<?php

namespace App\Database\Queries;

use App\Database\Models\Keyword\ResidenceState;
use App\Database\Models\Keyword\State;
use App\Database\Query;

class ResidenceStateQuery extends Query {

    public function stateQuery()
    {
        $subQuery = $this->qSelect(ResidenceState::STATE_ID)->getQuery();

        return inst(State::class)->aliasQuery()
            ->qWhereIn(State::ID, $subQuery);
    }

}
