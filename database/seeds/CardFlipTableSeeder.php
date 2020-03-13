<?php

namespace Database\Seeds\Table;

use App\Database\Models\Card;
use App\Database\Models\CardFlip;
use App\Database\Models\ChattingContent;
use Illuminate\Database\Seeder;

class CardFlipTableSeeder extends Seeder {

    public function run()
    {
        $count = Card::count();

        for ( $i = 0; $i < $count; $i++ )
        {
            $card = Card::skip($i)->first();

            foreach ( [
                $card->{Card::CHOOSER_ID},
                $card->{Card::SHOWNER_ID}
            ] as $userId )
            {
                $shouldFlip = (rand(0, 1) == 1);

                if ( $shouldFlip )
                {
                    $this->createCardFlip($card, $userId);
                }
            }
        }
    }

    public function createCardFlip($card, $userId)
    {
        $cardFlip = CardFlip::query()
            ->where(CardFlip::RELATED_ID, $card->getKey())
            ->where(CardFlip::USER_ID, $userId)
            ->first();

        if ( empty($cardFlip) )
        {
            $this->factory(CardFlip::class)->create([
                CardFlip::RELATED_ID => $card->getKey(),
                CardFlip::USER_ID => $userId,
            ]);
        }
    }

}
