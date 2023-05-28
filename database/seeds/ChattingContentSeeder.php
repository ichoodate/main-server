<?php

namespace Database\Seeds;

use App\Models\ChattingContent;
use App\Models\Friend;
use App\Models\Matching;
use Database\DatabaseSeeder;
use Illuminate\Support\Str;

class ChattingContentSeeder extends DatabaseSeeder
{
    public function run()
    {
        for ($i = 0; $i < Matching::count(); ++$i) {
            var_dump(static::class, $i);
            $match = Matching::find(Matching::select(Matching::ID)->skip($i)->first()->{Matching::ID});
            $friends = Friend::where(Friend::MATCH_ID, $match->getKey())->get();

            if (2 == $friends->count()) {
                for ($k = 0; $k < rand(0, 5); ++$k) {
                    $userId = rand(0, 1) ? $match->{Matching::MAN_ID} : $match->{Matching::WOMAN_ID};
                    $matchingUserId = $match->{Matching::MAN_ID} == $userId ? $match->{Matching::WOMAN_ID} : $match->{Matching::MAN_ID};
                    $this->add(ChattingContent::factory()->make([
                        ChattingContent::MATCH_ID => $match->getKey(),
                        ChattingContent::SENDER_ID => $userId,
                        ChattingContent::RECEIVER_ID => $matchingUserId,
                        ChattingContent::MESSAGE => Str::random(25),
                    ]));
                }
            }
        }
        $this->flush();
    }
}
