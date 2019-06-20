<?php

namespace Database\Seeds;

use App\Database\Models\Activity;
use App\Database\Models\Card;
use App\Database\Models\ChattingContent;
use App\Database\Models\ChattingRoom;
use Database\TableSeeder;

class ActivityTableSeeder extends TableSeeder {

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
                $shouldOpen = $shouldFlip & (rand(0, 2) == 2);
                $shouldPropose = $shouldOpen & (rand(0, 3) == 3);

                if ( $shouldFlip )
                {
                    $this->createFlipActivity($card, $userId);
                }

                if ( $shouldOpen )
                {
                    $this->createOpenActivity($card, $userId);
                }

                if ( $shouldPropose )
                {
                    $this->createProposeActivity($card, $userId);
                }
            }
        }
    }

    public function createFlipActivity($card, $userId)
    {
        $activity = Activity::query()
            ->where(Activity::RELATED_ID, $card->getKey())
            ->where(Activity::USER_ID, $userId)
            ->where(Activity::TYPE, Activity::TYPE_CARD_FLIP)
            ->first();

        if ( empty($activity) )
        {
            $this->factory(Activity::class)->create([
                Activity::RELATED_ID => $card->getKey(),
                Activity::USER_ID => $userId,
                Activity::TYPE => Activity::TYPE_CARD_FLIP
            ]);
        }
    }

    public function createOpenActivity($card, $userId)
    {
        $activity = Activity::query()
            ->where(Activity::RELATED_ID, $card->{Card::MATCH_ID})
            ->where(Activity::USER_ID, $userId)
            ->where(Activity::TYPE, Activity::TYPE_MATCH_OPEN)
            ->first();

        if ( empty($activity) )
        {
            $this->factory(Activity::class)->create([
                Activity::RELATED_ID => $card->getKey(),
                Activity::USER_ID => $userId,
                Activity::TYPE => Activity::TYPE_CARD_OPEN
            ]);

            $this->factory(Activity::class)->create([
                Activity::RELATED_ID => $card->{Card::MATCH_ID},
                Activity::USER_ID => $userId,
                Activity::TYPE => Activity::TYPE_MATCH_OPEN
            ]);
        }
    }

    public function createProposeActivity($card, $userId)
    {
        $activity = Activity::query()
            ->where(Activity::RELATED_ID, $card->{Card::MATCH_ID})
            ->where(Activity::TYPE, Activity::TYPE_MATCH_PROPOSE)
            ->first();

        if ( empty($activity) )
        {
            $this->factory(Activity::class)->create([
                Activity::RELATED_ID => $card->getKey(),
                Activity::USER_ID => $userId,
                Activity::TYPE => Activity::TYPE_CARD_PROPOSE
            ]);

            $this->factory(Activity::class)->create([
                Activity::RELATED_ID => $card->{Card::MATCH_ID},
                Activity::USER_ID => $userId,
                Activity::TYPE => Activity::TYPE_MATCH_PROPOSE
            ]);
        }
    }

}
