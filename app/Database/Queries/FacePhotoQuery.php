<?php

namespace App\Database\Queries;

use App\Database\Models\FacePhoto;
use App\Database\Models\User;
use App\Database\Query;

class FacePhotoQuery extends Query {

    public function userQuery()
    {
        $subQuery = $this->qSelect(FacePhoto::USER_ID)->getQuery();

        return inst(User::class)->query()
            ->qWhereIn(User::ID, $subQuery);
    }

}
