<?php

namespace Tests\Unit\App\Database\Queries;

use App\Database\Models\ChattingContent;
use App\Database\Models\Match;
use App\Database\Models\User;

class ChattingContentQueryTest extends _TestCase {

    public function testMatchQuery()
    {
        $this->assertBelongsToQuery(
            'match',
            ChattingContent::MATCH_ID,
            Match::class
        );
    }

    public function testWriterQuery()
    {
        $this->assertBelongsToQuery(
            'writer',
            ChattingContent::WRITER_ID,
            User::class
        );
    }

}
