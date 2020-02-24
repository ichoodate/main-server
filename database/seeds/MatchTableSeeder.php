<?php

namespace Database\Seeds;

use App\Database\Models\Match;
use App\Database\Models\Obj;
use App\Database\Models\User;
use Illuminate\Database\Seeder;

class MatchTableSeeder extends Seeder {

    public function run()
    {
        for ( $i = 0; $i < User::count(); $i++)
        {
            $user = User::skip($i)->first();

            if ( $user->{User::GENDER} == User::GENDER_MAN )
            {
                $userIdColumn      = Match::MAN_ID;
                $otherUserIdColumn = Match::WOMAN_ID;
                $otherUserQuery    = User::where('gender', User::GENDER_WOMAN);
            }
            else
            {
                $otherUserIdColumn = Match::MAN_ID;
                $userIdColumn      = Match::WOMAN_ID;
                $otherUserQuery    = User::where('gender', User::GENDER_MAN);
            }

            $otherUserCount = $otherUserQuery->count();

            for ( $j = 0; $j < rand(1, 6); $j++)
            {
                $otherUser = $otherUserQuery->skip(rand(0, $otherUserCount - 1))->first();

                $match = Match::query()
                    ->where($userIdColumn, $user->getKey())
                    ->where($otherUserIdColumn, $otherUser->getKey())->first();

                if ( empty($match) )
                {
                    $this->factory(Match::class)->create([
                        $userIdColumn      => $user->getKey(),
                        $otherUserIdColumn => $otherUser->getKey()
                    ]);
                }
            }
        }

    }

}
