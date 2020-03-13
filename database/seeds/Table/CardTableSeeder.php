<?php

namespace Database\Seeds\Table;

use App\Database\Models\Card;
use App\Database\Models\CardGroup;
use App\Database\Models\Match;
use App\Database\Models\User;
use Database\Seeds\TableSeeder;
use Illuminate\Support\Facades\DB;

class CardTableSeeder extends TableSeeder {

    public function run()
    {
        for ( $i = 0; $i < Match::count(); $i++ )
        {
            $match = Match::skip($i)->first();

            do
            {
                $manId     = $match->{Match::MAN_ID};
                $womanId   = $match->{Match::WOMAN_ID};

                if ( rand(0, 1) )
                {
                    $chooserId = $manId;
                    $shownerId = $womanId;
                }
                else
                {
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
                    ->first();

                if ( empty($card) || $card['count'] == 4 )
                {
                    $group = $this->factory(CardGroup::class)->create([
                        CardGroup::USER_ID => $chooser->getKey()
                    ]);
                }
                else
                {
                    $group = CardGroup::find($card->{Card::GROUP_ID});
                }

                $this->factory(Card::class)->create([
                    Card::CHOOSER_ID => $chooser->getKey(),
                    Card::SHOWNER_ID => $showner->getKey(),
                    Card::MATCH_ID   => $match->getKey(),
                    Card::GROUP_ID   => $group->getKey()
                ]);
            }
            while ( rand(1,5) == 5 );
        }
    }

}
