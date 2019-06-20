<?php

namespace Tests\Unit\App\Database\Queries;

use App\Database\Models\MatchingKwdPvt;
use App\Database\Models\Obj;
use Tests\Unit\App\Database\Queries\_TestCase;

class MatchingKwdPvtQueryTest extends _TestCase {

    public function testIdealTypeKeywordQuery()
    {
        $this->assertBelongsToQuery(
            'idealTypeKeyword',
            MatchingKwdPvt::IDEAL_TYPE_KWD_ID,
            Obj::class
        );
    }

    public function testMatchingKeywordQuery()
    {
        $this->assertBelongsToQuery(
            'matchingKeyword',
            MatchingKwdPvt::MATCHING_KWD_ID,
            Obj::class
        );
    }

}
