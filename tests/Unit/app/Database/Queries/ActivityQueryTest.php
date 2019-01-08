<?php

namespace Tests\Unit\App\Database\Queries;

use App\Database\Models\Activity;
use App\Database\Models\Notification;
use App\Database\Models\Obj;
use App\Database\Models\User;

class ActivityQueryTest extends _TestCase {

    public function testRelatedQuery()
    {
        $this->assertBelongsToQuery(
            'related',
            Activity::RELATED_ID,
            Obj::class
        );
    }

    public function testUserQuery()
    {
        $this->assertBelongsToQuery(
            'user',
            Activity::USER_ID,
            User::class
        );
    }

}
