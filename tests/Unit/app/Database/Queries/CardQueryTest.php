<?php

namespace Tests\Unit\App\Database\Queries;

use App\Database\Models\Activity;
use App\Database\Models\Card;
use App\Database\Models\CardGroup;
use App\Database\Models\Match;
use App\Database\Models\User;
use Tests\Unit\App\Database\Queries\_TestCase;

class CardQueryTest extends _TestCase {

    public function testActivityQuery()
    {
        $this->assertHasOneOrManyQuery(
            'activity',
            Activity::class,
            Activity::RELATED_ID
        );
    }

    public function testChooserQuery()
    {
        $this->assertBelongsToQuery(
            'chooser',
            Card::CHOOSER_ID,
            User::class
        );
    }

    public function testGroupQuery()
    {
        $this->assertBelongsToQuery(
            'group',
            Card::GROUP_ID,
            CardGroup::class
        );
    }

    public function testMatchQuery()
    {
        $this->assertBelongsToQuery(
            'match',
            Card::MATCH_ID,
            Match::class
        );
    }

    public function testShownerQuery()
    {
        $this->assertBelongsToQuery(
            'showner',
            Card::SHOWNER_ID,
            User::class
        );
    }

}
