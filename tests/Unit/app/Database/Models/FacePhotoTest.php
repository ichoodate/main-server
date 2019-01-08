<?php

namespace Tests\Unit\App\Database\Models;

use App\Database\Models\FacePhoto;
use App\Database\Models\User;

class FacePhotoTest extends _TestCase {

    public function testUserQuery()
    {
        $this->assertBelongsToQuery(
            'user',
            FacePhoto::USER_ID,
            User::class
        );
    }

}
