<?php

namespace Tests\Functional\IdealTypeKeyword;

use App\Models\IdealTypeKeyword;
use App\Models\Keyword\WeightRange;
use App\Models\User;
use Tests\Functional\_TestCase;

/**
 * @internal
 *
 * @coversNothing
 */
class WeightRangesPostTest extends _TestCase
{
    protected $uri = 'ideal-type-keyword/weight-ranges';

    public function test()
    {
        User::factory()->create(['id' => 1]);
        User::factory()->create(['id' => 2]);
        WeightRange::factory()->create(['id' => 11]);
        WeightRange::factory()->create(['id' => 12]);
        WeightRange::factory()->create(['id' => 13]);
        IdealTypeKeyword::factory()->create(['id' => 101, 'user_id' => 1, 'keyword_id' => 11]);
        IdealTypeKeyword::factory()->create(['id' => 102, 'user_id' => 1, 'keyword_id' => 12]);
        IdealTypeKeyword::factory()->create(['id' => 104, 'user_id' => 2, 'keyword_id' => 12]);

        $this->when(function () {
            $this->setAuthUser(User::find(1));
            $this->setInputParameter('keyword_id', 13);

            $this->runService();

            $this->assertResultWithPersisting(new IdealTypeKeyword([
                IdealTypeKeyword::USER_ID => 1,
                IdealTypeKeyword::KEYWORD_ID => 13,
            ]));
            $this->assertEquals(
                0,
                IdealTypeKeyword::query()
                    ->where(IdealTypeKeyword::USER_ID, 1)
                    ->whereIn(IdealTypeKeyword::KEYWORD_ID, [11, 12])
                    ->count()
            );
            $this->assertEquals(
                1,
                IdealTypeKeyword::query()
                    ->where(IdealTypeKeyword::USER_ID, 2)
                    ->where(IdealTypeKeyword::KEYWORD_ID, 12)
                    ->count()
            );
        });
    }

    public function testErrorIntegerRuleKeywordId()
    {
        $this->when(function () {
            $this->setInputParameter('keyword_id', 'abcd');

            $this->runService();

            $this->assertError('[keyword_id] must be an integer.');
        });
    }

    public function testErrorNotNullRuleKeywordModel()
    {
        WeightRange::factory()->create(['id' => 11, 'min' => 50, 'max' => 70]);
        WeightRange::factory()->create(['id' => 12, 'min' => 55, 'max' => 75]);

        $this->when(function () {
            $this->setInputParameter('keyword_id', 13);

            $this->runService();

            $this->assertError('weight_range keyword for [keyword_id] must exist.');
        });
    }

    public function testErrorRequiredRuleAuthUser()
    {
        $this->when(function () {
            $this->runService();

            $this->assertError('header[authorization] is required.');
        });
    }

    public function testErrorRequiredRuleKeywordId()
    {
        $this->when(function () {
            $this->runService();

            $this->assertError('[keyword_id] is required.');
        });
    }
}
