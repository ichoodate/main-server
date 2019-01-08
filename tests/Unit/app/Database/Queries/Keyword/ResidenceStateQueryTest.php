<?php

namespace Tests\Unit\App\Database\Queries;

use App\Database\Models\Keyword\State;
use App\Database\Models\Keyword\ResidenceState;

class ResidenceStateQueryTest extends _TestCase {

    public function testStateQuery()
    {
        $this->assertBelongsToQuery(
            'state',
            ResidenceState::STATE_ID,
            State::class
        );
    }

}
