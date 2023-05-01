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
        $count = Matching::count();

        for ($i = 0; $i < $count; ++$i) {
            $match = Matching::find(Matching::select(Matching::ID)->skip($i)->first()->{Matching::ID});
            $friends = Friend::where(Friend::MATCH_ID, $match->getKey())->get();

            if (2 == $friends->count()) {
                for ($k = 0; $k < rand(0, 5); ++$k) {
                    $userId = rand(0, 1) ? $match->{Matching::MAN_ID} : $match->{Matching::WOMAN_ID};
                    $this->add(ChattingContent::factory()->make([
                        ChattingContent::MATCH_ID => $match->getKey(),
                        ChattingContent::WRITER_ID => $userId,
                        ChattingContent::MESSAGE => Str::random(25),
                    ]));
                }
            }
        }
        $this->flush();
    }
}
