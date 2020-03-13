<?php

namespace Tests\Unit\App\Database\Models;

use App\Database\Models\Notification;
use App\Database\Models\Obj;
use App\Database\Models\User;
use Tests\Unit\App\Database\Models\_TestCase;

class NotificationTest extends _TestCase {

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
