<?php

namespace Tests\Functional\Keyword\Languages;

use App\Models\Keyword\Language;
use Tests\Functional\_TestCase;

/**
 * @internal
 * @coversNothing
 */
class GetTest extends _TestCase
{
    protected $uri = 'keyword/languages';

    public function test()
    {
        Language::factory()->create(['id' => 11, 'type' => 'aaa']);
        Language::factory()->create(['id' => 12, 'type' => 'bbb']);

        $this->when(function () {
            $this->runService();

            $this->assertResultWithListing([11, 12]);
        });
    }
}
