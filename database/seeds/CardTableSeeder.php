<?php

namespace Database\Seeds;

use App\Database\Models\Card;
use App\Database\Models\Match;
use App\Database\Models\User;

class CardTableSeeder extends TableSeeder {

    public function run()
    {
        for ( $i = 0; $i < Match::count(); $i++ )
        {
            $match = Match::skip($i)->first();

            for( $j = 0; $j < $count = rand(1, 3); $j++ )
            {
                $chooser = User::find(rand(0, 1) ? $match->{Match::MAN_ID} : $match->{Match::WOMAN_ID});
                $showner = User::find($match->{Match::MAN_ID} == $chooser->getKey() ? $match->{Match::WOMAN_ID} : $match->{Match::MAN_ID});

                Card::create([
                    Card::CHOOSER_ID => $chooser->getKey(),
                    Card::SHOWNER_ID => $showner->getKey(),
                    Card::MATCH_ID   => $match->getKey()
                ]);
            }
        }
    }

}
