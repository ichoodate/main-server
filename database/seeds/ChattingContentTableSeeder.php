<?php

namespace Database\Seeds;

use App\Database\Models\Activity;
use App\Database\Models\ChattingContent;
use App\Database\Models\Match;
use App\Database\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ChattingContentTableSeeder extends Seeder {

    public function run()
    {
        $query = Activity::where('type', Activity::TYPE_MATCH_PROPOSE);
        $count = $query->count();

        for ( $i = 0; $i < $count; $i++ )
        {
            $activity = $query->skip($i)->first();
            $matchId  = $activity->{Activity::RELATED_ID};
            $match    = Match::find($matchId);

            if ( rand(0, 1) )
            {
                $userId = $match->{Match::MAN_ID};
            }
            else
            {
                $userId = $match->{Match::WOMAN_ID};
            }

            for ( $k = 0; $k < rand(0, 5); $k++)
            {
                $this->factory(ChattingContent::class)->create([
                    ChattingContent::MATCH_ID  => $matchId,
                    ChattingContent::WRITER_ID => $userId,
                    ChattingContent::MESSAGE   => Str::random(25)
                ]);
            }
        }
    }

}
