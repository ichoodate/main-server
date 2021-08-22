<?php

namespace Database\Seeds\Table;

use App\Models\Card;
use App\Models\CardFlip;
use Illuminate\Database\Seeder;

class CardFlipTableSeeder extends Seeder
{
    public function createCardFlip($card, $userId)
    {
        $cardFlip = CardFlip::query()
            ->where(CardFlip::RELATED_ID, $card->getKey())
            ->where(CardFlip::USER_ID, $userId)
            ->first()
        ;

        if (empty($cardFlip)) {
            CardFlip::factory()->create([
                CardFlip::RELATED_ID => $card->getKey(),
                CardFlip::USER_ID => $userId,
            ]);
        }
    }

    public function run()
    {
        $count = Card::count();

        for ($i = 0; $i < $count; ++$i) {
            $card = Card::skip($i)->first();

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
