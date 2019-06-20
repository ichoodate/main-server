<?php

namespace Tests\Unit\App\Database\Models;

use App\Database\Models\MatchingKwdPvt;
use App\Database\Models\Obj;
use Tests\Unit\App\Database\Models\_TestCase;

class MatchingKwdPvtTest extends _TestCase {

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
