<?php

namespace Tests\Functional\Keyword\Languages;

use App\Database\Models\Keyword\Language;
use Tests\Functional\_TestCase;

/**
 * @internal
 * @coversNothing
 */
class GetTest extends _TestCase
{
    protected $uri = 'api/keyword/languages';

    public function test()
    {
        $this->factory(Language::class)->create(['id' => 11]);
        $this->factory(Language::class)->create(['id' => 12]);

        $this->when(function () {
            $this->assertResultWithListing([11, 12]);
        });
    }
}
