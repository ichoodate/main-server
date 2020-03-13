<?php

namespace Database\Seeds\Table;

use App\Database\Models\Card;
use App\Database\Models\CardFlip;
use App\Database\Models\Friend;
use Database\Seeds\TableSeeder;

class FriendTableSeeder extends TableSeeder {

    public function run()
    {
        for ( $i = 0; $i < CardFlip::count(); $i++ )
        {
            $flip = CardFlip::skip($i)->first();
            $card = $flip->card;

            if ( !rand(0, 3) )
            {
                $matchingUserId = $flip->{CardFlip::USER_ID} == $card->{Card::CHOOSER_ID} ? $card->{Card::SHOWNER_ID} : $card->{Card::CHOOSER_ID};

                Friend::create([
                    Friend::MATCH_ID    => $card->{Card::MATCH_ID},
                    Friend::SENDER_ID   => $matchingUserId,
                    Friend::RECEIVER_ID => $flip->{CardFlip::USER_ID}
                ]);
            }
        }
    }

}
