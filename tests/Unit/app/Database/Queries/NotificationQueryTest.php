<?php

namespace Tests\Unit\App\Database\Queries;

use App\Database\Models\Activity;
use App\Database\Models\Notification;
use App\Database\Models\User;
use Tests\Unit\App\Database\Queries\_TestCase;

class NotificationQueryTest extends _TestCase {

    public function testActivityQuery()
    {
        $this->assertBelongsToQuery(
            'activity',
            Notification::ACTIVITY_ID,
            Activity::class
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
