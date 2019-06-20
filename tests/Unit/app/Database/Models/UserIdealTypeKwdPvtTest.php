<?php

namespace Tests\Unit\App\Database\Models;

use App\Database\Models\UserIdealTypeKwdPvt;
use App\Database\Models\Obj;
use App\Database\Models\User;
use Tests\Unit\App\Database\Models\_TestCase;

class UserIdealTypeKwdPvtTest extends _TestCase {

    public function testKeywordQuery()
    {
        $this->assertBelongsToQuery(
            'keyword',
            UserIdealTypeKwdPvt::KEYWORD_ID,
            Obj::class
        );
    }

    public function testUserQuery()
    {
        $this->assertBelongsToQuery(
            'user',
            UserIdealTypeKwdPvt::USER_ID,
            User::class
        );
    }

}
