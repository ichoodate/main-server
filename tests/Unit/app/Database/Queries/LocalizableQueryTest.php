<?php

namespace Tests\Unit\App\Database\Queries;

use App\Database\Models\Localizable;
use App\Database\Models\Obj;

class LocalizableQueryTest extends _TestCase {

    public function testObjQuery()
    {
        $this->assertBelongsToQuery(
            'obj',
            Localizable::KEYWORD_ID,
            Obj::class
        );
    }

}
