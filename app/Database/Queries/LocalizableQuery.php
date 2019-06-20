<?php

namespace App\Database\Queries;

use App\Database\Models\Localizable;
use App\Database\Models\Obj;
use App\Database\Query;

class LocalizableQuery extends Query {

    public function keywordQuery()
    {
        $subQuery = $this->qSelect(Localizable::KEYWORD_ID)->getQuery();

        return inst(Obj::class)->query()
            ->qWhereIn(Obj::ID, $subQuery);
    }

}
