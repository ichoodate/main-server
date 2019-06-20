<?php

namespace App\Database\Queries;

use App\Database\Models\ChattingContent;
use App\Database\Models\Match;
use App\Database\Models\User;
use App\Database\Query;

class ChattingContentQuery extends Query {

    public function matchQuery()
    {
        $subQuery = $this->qSelect(ChattingContent::MATCH_ID)->getQuery();

        return inst(Match::class)->query()
            ->qWhereIn(Match::ID, $subQuery);
    }

    public function writerQuery()
    {
        $subQuery = $this->qSelect(ChattingContent::WRITER_ID)->getQuery();

        return inst(User::class)->query()
            ->qWhereIn(User::ID, $subQuery);
    }

}
