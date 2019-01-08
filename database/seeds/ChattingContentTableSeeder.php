<?php

namespace Database\Seeds;

use App\Database\Models\Activity;
use App\Database\Models\ChattingRoom;
use App\Database\Models\ChattingContent;
use App\Database\Models\Match;
use App\Database\Models\User;

class ChattingContentTableSeeder extends TableSeeder {

    public function run()
    {
        for ( $i = 0; $i < ChattingRoom::count(); $i++ )
        {
            $chattingRoom = ChattingRoom::aliasQuery()->skip($i)->first();
            $match        = Match::find($chattingRoom->{ChattingRoom::MATCH_ID});
            $userKey      = rand(0, 1) ? $match->{Match::MAN_ID} : $match->{Match::WOMAN_ID};

            for ( $j = 0; $j < $count = rand(0, 5); $j++)
            {
                ChattingContent::create([
                    ChattingContent::CHATTING_ROOM_ID => $chattingRoom->getKey(),
                    ChattingContent::WRITER_ID          => $userKey,
                    ChattingContent::MESSAGE          => str_random(25)
                ]);
            }
        }
    }

}
