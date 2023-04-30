<?php

namespace Database\Seeds;

use App\Models\Card;
use App\Models\CardGroup;
use App\Models\Matching;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CardSeeder extends Seeder
{
    public function run()
    {
        for ($i = 0; $i < Matching::count(); ++$i) {
            $match = Matching::skip($i)->first();

            do {
                $manId = $match->{Matching::MAN_ID};
                $womanId = $match->{Matching::WOMAN_ID};

                if (rand(0, 1)) {
                    $chooserId = $manId;
                    $shownerId = $womanId;
                } else {
                    $shownerId = $manId;
                    $chooserId = $womanId;
                }

                $chooser = User::find($chooserId);
                $showner = User::find($shownerId);

                $card = Card::query()
                    ->select(['*', DB::raw('count('.Card::GROUP_ID.') as count')])
                    ->where(Card::CHOOSER_ID, $chooser->getKey())
                    ->groupBy(Card::GROUP_ID)
                    ->orderBy('count', 'asc')
                    ->first()
                ;

                if (empty($card) || 4 == $card['count']) {
                    $group = CardGroup::factory()->create([
                        CardGroup::USER_ID => $chooser->getKey(),
                    ]);
                } else {
                    $group = CardGroup::find($card->{Card::GROUP_ID});
                }

                Card::factory()->create([
                    Card::CHOOSER_ID => $chooser->getKey(),
                    Card::SHOWNER_ID => $showner->getKey(),
                    Card::MATCH_ID => $match->getKey(),
                    Card::GROUP_ID => $group->getKey(),
                ]);
            } while (5 == rand(1, 5));
        }
    }
}
