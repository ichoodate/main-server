<?php

namespace Tests\Unit\App\Database\Models;

use App\Database\Models\Activity;
use App\Database\Models\Card;
use App\Database\Models\ChattingContent;
use App\Database\Models\Match;
use App\Database\Models\User;
use Tests\Unit\App\Database\Models\_TestCase;

class MatchTest extends _TestCase {

    public function testActivityQuery()
    {
        $this->assertHasOneOrManyQuery(
            'activity',
            Activity::class,
            Activity::RELATED_ID
        );
    }

    public function testCardQuery()
    {
        $this->assertHasOneOrManyQuery(
            'card',
            Card::class,
            Card::MATCH_ID
        );
    }

    public function testChattingContentQuery()
    {
        $this->assertHasOneOrManyQuery(
            'chattingContent',
            ChattingContent::class,
            ChattingContent::MATCH_ID
        );
    }

    public function testManQuery()
    {
        $this->assertBelongsToQuery(
            'man',
            Match::MAN_ID,
            User::class
        );
    }

    public function testWomanQuery()
    {
        $this->assertBelongsToQuery(
            'woman',
            Match::WOMAN_ID,
            User::class
        );
    }

}
