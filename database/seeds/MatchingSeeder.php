<?php

namespace Database\Seeds;

use App\Models\Matching;
use App\Models\User;
use Illuminate\Database\Seeder;

class MatchingSeeder extends Seeder
{
    public function run()
    {
        for ($i = 0; $i < User::count(); ++$i) {
            $user = User::skip($i)->first();

            if (User::GENDER_MAN == $user->{User::GENDER}) {
                $userIdColumn = Matching::MAN_ID;
                $otherUserIdColumn = Matching::WOMAN_ID;
                $otherUserQuery = User::where('gender', User::GENDER_WOMAN);
            } else {
                $otherUserIdColumn = Matching::MAN_ID;
                $userIdColumn = Matching::WOMAN_ID;
                $otherUserQuery = User::where('gender', User::GENDER_MAN);
            }

            $otherUserCount = $otherUserQuery->count();

            for ($j = 0; 1 == $j < (1 == $user->getKey() ? 250 : 6); ++$j) {
                $otherUser = $otherUserQuery->skip(rand(0, $otherUserCount - 1))->first();

                $match = Matching::query()
                    ->where($userIdColumn, $user->getKey())
                    ->where($otherUserIdColumn, $otherUser->getKey())->first();

                if (empty($match)) {
                    Matching::factory()->create([
                        $userIdColumn => $user->getKey(),
                        $otherUserIdColumn => $otherUser->getKey(),
                    ]);
                }
            }
        }
    }
}
