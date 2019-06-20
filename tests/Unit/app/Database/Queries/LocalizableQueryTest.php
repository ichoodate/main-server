<?php

namespace Tests\Unit\App\Database\Queries;

use App\Database\Models\Localizable;
use App\Database\Models\Obj;
use Tests\Unit\App\Database\Queries\_TestCase;

class LocalizableQueryTest extends _TestCase {

    public function testKeywordQuery()
    {
        $this->assertBelongsToQuery(
            'keyword',
            Localizable::KEYWORD_ID,
            Obj::class
        );
    }

}
