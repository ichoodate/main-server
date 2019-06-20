<?php

namespace Tests\Unit\App\Database\Queries;

use App\Database\Models\Obj;
use App\Database\Models\UserSelfKwdPvt;
use App\Database\Models\User;
use Tests\Unit\App\Database\Queries\_TestCase;

class UserSelfKwdPvtQueryTest extends _TestCase {

    public function testKeywordQuery()
    {
        $this->assertBelongsToQuery(
            'keyword',
            UserSelfKwdPvt::KEYWORD_ID,
            Obj::class
        );
    }

    public function testUserQuery()
    {
        $this->assertBelongsToQuery(
            'user',
            UserSelfKwdPvt::USER_ID,
            User::class
        );
    }

}
