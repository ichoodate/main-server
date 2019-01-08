<?php

namespace App\Database\Queries;

use App\Database\Models\ProfilePhoto;
use App\Database\Models\User;
use App\Database\Query;

class ProfilePhotoQuery extends Query {

    public function userQuery()
    {
        $subQuery = $this->qSelect(ProfilePhoto::USER_ID)->getQuery();

        return inst(User::class)->aliasQuery()
            ->qWhereIn(User::ID, $subQuery);
    }

}
