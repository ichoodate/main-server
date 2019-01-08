<?php

namespace Tests\Unit\App\Database\Models;

use App\Database\Models\ProfilePhoto;
use App\Database\Models\User;

class ProfilePhotoTest extends _TestCase {

    public function testUserQuery()
    {
        $this->assertBelongsToQuery(
            'user',
            ProfilePhoto::USER_ID,
            User::class
        );
    }

}
