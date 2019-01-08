<?php

namespace Tests\Unit\App\Database\Models;

use App\Database\Models\User;
use App\Database\Models\Popularity;

class PopularityTest extends _TestCase {

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
