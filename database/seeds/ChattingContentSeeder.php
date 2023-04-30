<?php

namespace Database\Seeds;

use App\Models\ChattingContent;
use App\Models\Friend;
use App\Models\Matching;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ChattingContentSeeder extends Seeder
{
    public function run()
    {
        $count = Matching::count();

        for ($i = 0; $i < $count; ++$i) {
            $match = Matching::skip($i)->first();
            $friends = Friend::where(Friend::MATCH_ID, $match->getKey())->get();

            if (2 == $friends->count()) {
                for ($k = 0; $k < rand(0, 5); ++$k) {
                    $userId = rand(0, 1) ? $match->{Matching::MAN_ID} : $match->{Matching::WOMAN_ID};
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
