<?php

namespace Database\Seeds;

use App\Database\Models\Match;
use App\Database\Models\Obj;
use App\Database\Models\User;

class MatchTableSeeder extends TableSeeder {

    public function run()
    {
        for ( $i = 0; $i < User::count(); $i++)
        {
            $user           = User::skip($i)->first();
            $womanQuery     = User::qWhere(User::GENDER, User::GENDER_WOMAN);
            $manQuery       = User::qWhere(User::GENDER, User::GENDER_MAN);
            $otherUserQuery = $user->{User::GENDER} == User::GENDER_MAN ? $womanQuery : $manQuery;
            $otherUserCount = (clone $otherUserQuery)->count();

            for ( $j = 0; $j < rand(1, 6); $j++)
            {
                $otherUser = (clone $otherUserQuery)->skip(rand(0, $otherUserCount - 1))->first();

                $userIdColumn      = $user->{User::GENDER} == User::GENDER_MAN ? Match::MAN_ID : Match::WOMAN_ID;
                $otherUserIdColumn = $otherUser->{User::GENDER} == User::GENDER_MAN ? Match::MAN_ID : Match::WOMAN_ID;

                $match = Match::qWhere($userIdColumn, $user->getKey())->qWhere($otherUserIdColumn, $otherUser->getKey())->first();

                if ( empty($match) )
                {
                    Match::create([
                        $userIdColumn      => $user->getKey(),
                        $otherUserIdColumn => $otherUser->getKey()
                    ]);

                }
            }
        }

    }

}
