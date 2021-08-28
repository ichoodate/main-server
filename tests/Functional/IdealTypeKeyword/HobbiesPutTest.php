<?php

namespace Tests\Functional\IdealTypeKeyword;

use App\Models\IdealTypeKeyword;
use App\Models\Keyword\Hobby;
use App\Models\User;
use Tests\Functional\_TestCase;

/**
 * @internal
 * @coversNothing
 */
class HobbiesPutTest extends _TestCase
{
    protected $uri = 'ideal-type-keyword/hobbies';

    public function test()
    {
        User::factory()->create(['id' => 1]);
        User::factory()->create(['id' => 2]);
        Hobby::factory()->create(['id' => 11, 'type' => 'aaa']);
        Hobby::factory()->create(['id' => 12, 'type' => 'bbb']);
        Hobby::factory()->create(['id' => 13, 'type' => 'ccc']);
        Hobby::factory()->create(['id' => 14, 'type' => 'ddd']);
        IdealTypeKeyword::factory()->create(['id' => 101, 'user_id' => 1, 'keyword_id' => 11]);
        IdealTypeKeyword::factory()->create(['id' => 102, 'user_id' => 1, 'keyword_id' => 12]);
        IdealTypeKeyword::factory()->create(['id' => 104, 'user_id' => 2, 'keyword_id' => 12]);

        $this->when(function () {
            $this->setAuthUser(User::find(1));
            $this->setInputParameter('keyword_ids', '14,13');

            $this->runService();

            $this->assertResultWithPersisting(collect([
                new IdealTypeKeyword([
                    IdealTypeKeyword::USER_ID => 1,
                    IdealTypeKeyword::KEYWORD_ID => 14,
                ]),
                new IdealTypeKeyword([
                    IdealTypeKeyword::USER_ID => 1,
                    IdealTypeKeyword::KEYWORD_ID => 13,
                ]),
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
        User::factory()->create(['id' => 1]);

        $this->when(function () {
            $this->setAuthUser(User::find(1));
            $this->setInputParameter('keyword_ids', 'abcd');

            $this->runService();

            $this->assertError('[keyword_ids] must be integers separated by commas.');
        });
    }

    public function testErrorNotNullRuleKeywordModel()
    {
        User::factory()->create(['id' => 1]);
        Hobby::factory()->create(['id' => 11, 'type' => 'aaa']);
        Hobby::factory()->create(['id' => 12, 'type' => 'bbb']);

        $this->when(function () {
            $this->setAuthUser(User::find(1));
            $this->setInputParameter('keyword_ids', 13);

            $this->runService();

            $this->assertError('hobbies[0] for [keyword_ids] must exist.');
        });
    }

    public function testErrorRequiredRuleAuthUser()
    {
        User::factory()->create(['id' => 1]);

        $this->when(function () {
            $this->runService();

            $this->assertError('header[authorization] is required.');
        });
    }

    public function testErrorRequiredRuleKeywordId()
    {
        User::factory()->create(['id' => 1]);

        $this->when(function () {
            $this->setAuthUser(User::find(1));

            $this->runService();

            $this->assertError('[keyword_ids] is required.');
        });
    }
}
