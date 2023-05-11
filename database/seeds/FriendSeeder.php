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
            var_dump(static::class, $i);
            $flip = CardFlip::find(CardFlip::select(CardFlip::ID)->skip($i)->first()->{CardFlip::ID});
            $card = $flip->card;

            if (0 !== rand(0, 2)) {
                $userId = $flip->{CardFlip::USER_ID};
                $otherUserId = $userId == $card->{Card::CHOOSER_ID} ? $card->{Card::SHOWNER_ID} : $card->{Card::CHOOSER_ID};

                if (0 == Friend::where(Friend::SENDER_ID, $userId)->count()) {
                    Friend::factory()->create([
                        Friend::MATCH_ID => $card->{Card::MATCH_ID},
                        Friend::SENDER_ID => $userId,
                        Friend::RECEIVER_ID => $otherUserId,
                    ]);
                }

                if (0 !== rand(0, 2)) {
                    if (0 == Friend::where(Friend::SENDER_ID, $otherUserId)->count()) {
                        Friend::factory()->create([
                            Friend::MATCH_ID => $card->{Card::MATCH_ID},
                            Friend::SENDER_ID => $otherUserId,
                            Friend::RECEIVER_ID => $userId,
                        ]);
                    }
                }
            }
        }
    }
}
