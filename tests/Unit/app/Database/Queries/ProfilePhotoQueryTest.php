<?php

namespace Tests\Unit\App\Database\Queries;

use App\Database\Models\ProfilePhoto;
use App\Database\Models\User;

class ProfilePhotoQueryTest extends _TestCase {

    public function testUserQuery()
    {
        $this->assertBelongsToQuery(
            'user',
            ProfilePhoto::USER_ID,
            User::class
        );
    }

}
