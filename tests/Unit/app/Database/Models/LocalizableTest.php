<?php

namespace Tests\Unit\App\Database\Models;

use App\Database\Models\Localizable;
use App\Database\Models\Obj;

class LocalizableTest extends _TestCase {

    public function testObjQuery()
    {
        $this->assertBelongsToQuery(
            'obj',
            Localizable::KEYWORD_ID,
            Obj::class
        );
    }

}
