<?php

namespace Tests\Functional\UserKeyword;

use App\Models\Keyword\Hobby;
use App\Models\User;
use App\Models\UserKeyword;
use Tests\Functional\_TestCase;

/**
 * @internal
 * @coversNothing
 */
class HobbiesPutTest extends _TestCase
{
    protected $uri = 'user-keyword/hobbies';

    public function test()
    {
        User::factory()->create(['id' => 1]);
        User::factory()->create(['id' => 2]);
        Hobby::factory()->create(['id' => 11, 'type' => 'aaa']);
        Hobby::factory()->create(['id' => 12, 'type' => 'bbb']);
        Hobby::factory()->create(['id' => 13, 'type' => 'ccc']);
        Hobby::factory()->create(['id' => 14, 'type' => 'ddd']);
        UserKeyword::factory()->create(['id' => 101, 'user_id' => 1, 'keyword_id' => 11]);
        UserKeyword::factory()->create(['id' => 102, 'user_id' => 1, 'keyword_id' => 12]);
        UserKeyword::factory()->create(['id' => 104, 'user_id' => 2, 'keyword_id' => 12]);

        $this->when(function () {
            $this->setAuthUser(User::find(1));
            $this->setInputParameter('keyword_ids', '14,13');

            $this->runService();

            $this->assertResultWithPersisting(collect([
                new UserKeyword([
                    UserKeyword::USER_ID => 1,
                    UserKeyword::KEYWORD_ID => 14,
                ]),
                new UserKeyword([
                    UserKeyword::USER_ID => 1,
                    UserKeyword::KEYWORD_ID => 13,
                ]),
            ]));
            $this->assertEquals(
                0,
                UserKeyword::query()
                    ->where(UserKeyword::USER_ID, 1)
                    ->whereIn(UserKeyword::KEYWORD_ID, [11, 12])
                    ->count()
            );
            $this->assertEquals(
                1,
                UserKeyword::query()
                    ->where(UserKeyword::USER_ID, 2)
                    ->where(UserKeyword::KEYWORD_ID, 12)
                    ->count()
            );
        });
    }

    public function testErrorIntegerRuleKeywordIds()
    {
        $this->when(function () {
            $this->setInputParameter('keyword_ids', 'abcd');

            $this->runService();

            $this->assertError('[keyword_ids] must be integers separated by commas.');
        });
    }

    public function testErrorNotNullRuleKeywordModel()
    {
        Hobby::factory()->create(['id' => 11, 'type' => 'aaa']);
        Hobby::factory()->create(['id' => 12, 'type' => 'bbb']);

        $this->when(function () {
            $this->setInputParameter('keyword_ids', 13);

            $this->runService();

            $this->assertError('hobbies[0] for [keyword_ids] must exist.');
        });
    }

    public function testErrorRequiredRuleAuthUser()
    {
        $this->when(function () {
            $this->runService();

            $this->assertError('header[authorization] is required.');
        });
    }

    public function testErrorRequiredRuleKeywordIds()
    {
        $this->when(function () {
            $this->runService();

            $this->assertError('[keyword_ids] is required.');
        });
    }
}
