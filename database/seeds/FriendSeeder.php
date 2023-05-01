<?php

namespace Database\Seeds;

use App\Models\Card;
use App\Models\CardFlip;
use App\Models\Friend;
use Database\DatabaseSeeder;

class FriendSeeder extends DatabaseSeeder
{
    public function run()
    {
        for ($i = 0; $i < CardFlip::count(); ++$i) {
            $flip = CardFlip::find(CardFlip::select(CardFlip::ID)->skip($i)->first()->{CardFlip::ID});
            $card = $flip->card;

            if (0 !== rand(0, 2)) {
                $senderId = $flip->{CardFlip::USER_ID} == $card->{Card::CHOOSER_ID} ? $card->{Card::SHOWNER_ID} : $card->{Card::CHOOSER_ID};

                Friend::factory()->create([
                    Friend::MATCH_ID => $card->{Card::MATCH_ID},
                    Friend::SENDER_ID => $senderId,
                    Friend::RECEIVER_ID => $flip->{CardFlip::USER_ID},
                ]);
            }
        }
    }
}
