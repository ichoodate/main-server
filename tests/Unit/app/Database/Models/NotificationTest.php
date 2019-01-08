<?php

namespace Tests\Unit\App\Database\Models;

use App\Database\Models\Activity;
use App\Database\Models\Notification;
use App\Database\Models\User;

class NotificationTest extends _TestCase {

    public function testUserQuery()
    {
        $this->assertBelongsToQuery(
            'user',
            Notification::USER_ID,
            User::class
        );
    }

}
