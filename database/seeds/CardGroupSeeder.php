<?php

namespace Database\Seeds;

use App\Models\CardGroup;
use App\Models\User;
use Database\DatabaseSeeder;

class CardGroupSeeder extends DatabaseSeeder
{
    public function run()
    {
        for ($userId = 1; $userId <= User::count(); ++$userId) {
            var_dump(static::class, $userId);
            foreach (range(1, rand(1, 5)) as $i) {
                $this->add(CardGroup::factory()->make([
                    CardGroup::USER_ID => $userId,
                    CardGroup::TYPE => CardGroup::TYPE_DAILY,
                ]));
            }
        }
        $this->flush();
    }
}
