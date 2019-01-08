<?php

namespace Tests\Unit\App\Database\Models;

use App\Database\Models\IdealTypable;
use App\Database\Models\Obj;
use App\Database\Models\User;

class IdealTypableTest extends _TestCase {

    public function testObjQuery()
    {
        $this->assertBelongsToQuery(
            'obj',
            IdealTypable::KEYWORD_ID,
            Obj::class
        );
    }

    public function testUserQuery()
    {
        $this->assertBelongsToQuery(
            'user',
            IdealTypable::USER_ID,
            User::class
        );
    }

}
