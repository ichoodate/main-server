<?php

namespace Database\Seeds\Table;

use App\Models\ChattingContent;
use App\Models\Friend;
use App\Models\Match;
use Database\Seeds\TableSeeder;
use Illuminate\Support\Str;

class ChattingContentTableSeeder extends TableSeeder
{
    public function run()
    {
        $count = Match::count();

        for ($i = 0; $i < $count; ++$i) {
            $match = Match::skip($i)->first();
            $friends = Friend::where(Friend::MATCH_ID, $match->getKey())->get();
            $userId = rand(0, 1) ? $match->{Match::MAN_ID} : $match->{Match::WOMAN_ID};

            if (2 == $friends->count()) {
                for ($k = 0; $k < rand(0, 5); ++$k) {
                    ChattingContent::factory()->create([
                        ChattingContent::MATCH_ID => $match->getKey(),
                        ChattingContent::WRITER_ID => $userId,
                        ChattingContent::MESSAGE => Str::random(25),
                    ]);
                }
            }
        }
    }
}
