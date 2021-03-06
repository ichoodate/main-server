<?php

namespace Database\Seeds;

use App\Models\Match;
use App\Models\User;
use Illuminate\Database\Seeder;

class MatchSeeder extends Seeder
{
    public function run()
    {
        for ($i = 0; $i < User::count(); ++$i) {
            $user = User::skip($i)->first();

            if (User::GENDER_MAN == $user->{User::GENDER}) {
                $userIdColumn = Match::MAN_ID;
                $otherUserIdColumn = Match::WOMAN_ID;
                $otherUserQuery = User::where('gender', User::GENDER_WOMAN);
            } else {
                $otherUserIdColumn = Match::MAN_ID;
                $userIdColumn = Match::WOMAN_ID;
                $otherUserQuery = User::where('gender', User::GENDER_MAN);
            }

            $otherUserCount = $otherUserQuery->count();

            for ($j = 0; 1 == $j < (1 == $user->getKey() ? 250 : 6); ++$j) {
                $otherUser = $otherUserQuery->skip(rand(0, $otherUserCount - 1))->first();

                $match = Match::query()
                    ->where($userIdColumn, $user->getKey())
                    ->where($otherUserIdColumn, $otherUser->getKey())->first();

                if (empty($match)) {
                    Match::factory()->create([
                        $userIdColumn => $user->getKey(),
                        $otherUserIdColumn => $otherUser->getKey(),
                    ]);
                }
            }
        }
    }
}
