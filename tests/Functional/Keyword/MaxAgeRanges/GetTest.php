<?php

namespace Tests\Functional\Keyword\MaxAgeRanges;

use App\Database\Models\Keyword\AgeRange;
use Tests\Functional\_TestCase;

/**
 * @internal
 * @coversNothing
 */
class GetTest extends _TestCase
{
    protected $uri = 'api/keyword/max-age-ranges';

    public function test()
    {
        $this->factory(AgeRange::class)->create(['id' => 11, 'min' => 21]);
        $this->factory(AgeRange::class)->create(['id' => 12, 'min' => 22]);
        $this->factory(AgeRange::class)->create(['id' => 13, 'min' => 22]);

        $this->when(function () {
            $this->setInputParameter('min', 21);

            $this->assertResultWithListing([11]);
        });

        $this->when(function () {
            $this->setInputParameter('min', 22);

            $this->assertResultWithFinding([12, 13]);
        });
    }
}
