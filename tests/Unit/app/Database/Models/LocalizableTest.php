<?php

namespace Tests\Unit\App\Database\Models;

use App\Database\Models\Localizable;
use App\Database\Models\Obj;
use Tests\Unit\App\Database\Models\_TestCase;

class LocalizableTest extends _TestCase {

    public function testKeywordQuery()
    {
        $this->assertBelongsToQuery(
            'keyword',
            Localizable::KEYWORD_ID,
            Obj::class
        );
    }

}
