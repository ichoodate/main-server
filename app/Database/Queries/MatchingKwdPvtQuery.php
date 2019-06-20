<?php

namespace App\Database\Queries;

use App\Database\Models\MatchingKwdPvt;
use App\Database\Models\Obj;
use App\Database\Query;

class MatchingKwdPvtQuery extends Query {

    public function idealTypeKeywordQuery()
    {
        $subQuery = $this->qSelect(MatchingKwdPvt::IDEAL_TYPE_KWD_ID)->getQuery();

        return inst(Obj::class)->query()
            ->qWhereIn(Obj::ID, $subQuery);
    }

    public function matchingKeywordQuery()
    {
        $subQuery = $this->qSelect(MatchingKwdPvt::MATCHING_KWD_ID)->getQuery();

        return inst(Obj::class)->query()
            ->qWhereIn(Obj::ID, $subQuery);
    }

}
