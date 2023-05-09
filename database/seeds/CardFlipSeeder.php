<?php

namespace Database\Seeds;

use App\Models\Card;
use App\Models\CardFlip;
use Database\DatabaseSeeder;

class CardFlipSeeder extends DatabaseSeeder
{
    public function createCardFlip($card, $userId)
    {
        $cardFlip = CardFlip::query()
            ->where(CardFlip::CARD_ID, $card->getKey())
            ->where(CardFlip::USER_ID, $userId)
            ->first()
        ;

        if (empty($cardFlip)) {
            $this->add(CardFlip::factory()->make([
                CardFlip::CARD_ID => $card->getKey(),
                CardFlip::USER_ID => $userId,
            ]));
        }
    }

    public function run()
    {
        $i = 0;
        while ($cards = $this->getChunk(Card::class, $i++)) {
            var_dump(static::class, $i);
            foreach ($cards as $card) {
                foreach ([
                    $card->{Card::CHOOSER_ID},
                    $card->{Card::SHOWNER_ID},
                ] as $userId) {
                    $shouldFlip = (1 == rand(0, 1));

                    if ($shouldFlip) {
                        $this->createCardFlip($card, $userId);
                    }
                }
            }
        }
    }
}
