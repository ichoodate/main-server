<?php

namespace Database\Seeds;

use App\Models\Card;
use App\Models\CardGroup;
use App\Models\Matching;
use App\Models\User;
use Database\DatabaseSeeder;

class CardSeeder extends DatabaseSeeder
{
    public function run()
    {
        for ($i = 0; $i < CardGroup::count(); ++$i) {
            var_dump(static::class, $i);
            $cardGroup = CardGroup::find(CardGroup::select(CardGroup::ID)->skip($i)->first()->{CardGroup::ID});
            $chooser = User::find($cardGroup->{CardGroup::USER_ID});
            $chooserGender = $chooser->{User::GENDER};
            $shownerGender = User::GENDER_MAN == $chooserGender ? User::GENDER_WOMAN : User::GENDER_MAN;
            $showners = User::query()
                ->select(User::ID)
                ->where(User::GENDER, $shownerGender)
                ->orderByRaw('rand()')
                ->limit(4)
                ->get()
            ;
            foreach ($showners as $showner) {
                $match = Matching::query()
                    ->select(Matching::ID)
                    ->where($shownerGender.'_id', $showner->{User::ID})
                    ->where($chooserGender.'_id', $chooser->{User::ID})
                    ->first()
                ;
                if (empty($match)) {
                    $match = Matching::factory()->make([
                        $shownerGender.'_id' => $showner->{User::ID},
                        $chooserGender.'_id' => $chooser->{User::ID},
                    ]);
                }
                $card = Card::factory()->make([
                    Card::GROUP_ID => $cardGroup->getKey(),
                    Card::CHOOSER_ID => $chooser->{User::ID},
                    Card::SHOWNER_ID => $showner->{User::ID},
                ]);
                $card->parents = [
                    Card::MATCH_ID => $match,
                ];
                $this->add($card);
            }
        }
        $this->flush();
    }
}
