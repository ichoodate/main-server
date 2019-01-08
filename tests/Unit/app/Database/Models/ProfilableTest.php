<?php

namespace Tests\Unit\App\Database\Models;

use App\Database\Models\Obj;
use App\Database\Models\Profilable;
use App\Database\Models\User;

class ProfilableTest extends _TestCase {

    public function testObjQuery()
    {
        $this->assertBelongsToQuery(
            'obj',
            Profilable::KEYWORD_ID,
            Obj::class
        );
    }

    public function testUserQuery()
    {
        $this->assertBelongsToQuery(
            'user',
            Profilable::USER_ID,
            User::class
        );
    }

}
