<?php

namespace Tests\Unit\App\Database\Queries;

use App\Database\Models\FacePhoto;
use App\Database\Models\User;

class FacePhotoQueryTest extends _TestCase {

    public function testUserQuery()
    {
        $this->assertBelongsToQuery(
            'user',
            FacePhoto::USER_ID,
            User::class
        );
    }

}
