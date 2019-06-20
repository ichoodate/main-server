<?php

namespace Tests\Unit\App\Database\Queries;

use App\Database\Models\User;
use App\Database\Models\Popularity;
use Tests\Unit\App\Database\Queries\_TestCase;

class PopularityQueryTest extends _TestCase {

    public function testReceiverQuery()
    {
        $this->assertBelongsToQuery(
            'receiver',
            Popularity::RECEIVER_ID,
            User::class
        );
    }

    public function testSenderQuery()
    {
        $this->assertBelongsToQuery(
            'sender',
            Popularity::SENDER_ID,
            User::class
        );
    }

}
