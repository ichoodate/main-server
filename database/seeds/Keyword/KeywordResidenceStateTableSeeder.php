<?php

namespace Database\Seeds;

use App\Database\Models\Obj;
use App\Database\Models\Keyword\State;
use App\Database\Models\Keyword\ResidenceState;

class ResidenceStateTableSeeder extends TableSeeder {

    public function run()
    {
        $count = State::count();

        for ( $i = 0; $i < $count; $i++ )
        {
            $keywordState = State::skip($i)->first();

            ResidenceState::create([
                ResidenceState::STATE_ID => $keywordState->getKey()
            ]);
        }
    }
}
