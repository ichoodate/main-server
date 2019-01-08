<?php

namespace Tests\Unit\App\Database\Models;

use App\Database\Models\Obj;
use App\Database\Models\Keyword\State;
use App\Database\Models\Keyword\ResidenceState;

class ResidenceStateTest extends _TestCase {

    public function testStateQuery()
    {
        $this->assertBelongsToQuery(
            'state',
            ResidenceState::STATE_ID,
            State::class
        );
    }

}
