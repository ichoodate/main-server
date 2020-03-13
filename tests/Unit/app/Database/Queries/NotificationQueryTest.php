<?php

namespace Tests\Unit\App\Database\Queries;

use App\Database\Models\Obj;
use App\Database\Models\Notification;
use App\Database\Models\User;
use Tests\Unit\App\Database\Queries\_TestCase;

class NotificationQueryTest extends _TestCase {

    public function testRelatedQuery()
    {
        $this->assertBelongsToQuery(
            'related',
            Notification::RELATED_ID,
            Obj::class
        );
    }

    public function testUserQuery()
    {
        $this->assertBelongsToQuery(
            'user',
            Notification::USER_ID,
            User::class
        );
    }

}
