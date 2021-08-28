<?php

namespace Tests\Functional\UserKeyword;

use App\Models\Keyword\Drink;
use App\Models\User;
use App\Models\UserKeyword;
use Tests\Functional\_TestCase;

/**
 * @internal
 * @coversNothing
 */
class DrinksPostTest extends _TestCase
{
    protected $uri = 'user-keyword/drinks';

    public function test()
    {
        User::factory()->create(['id' => 1]);
        User::factory()->create(['id' => 2]);
        Drink::factory()->create(['id' => 11, 'type' => 'aaa']);
        Drink::factory()->create(['id' => 12, 'type' => 'bbb']);
        Drink::factory()->create(['id' => 13, 'type' => 'ccc']);
        UserKeyword::factory()->create(['id' => 101, 'user_id' => 1, 'keyword_id' => 11]);
        UserKeyword::factory()->create(['id' => 102, 'user_id' => 1, 'keyword_id' => 12]);
        UserKeyword::factory()->create(['id' => 104, 'user_id' => 2, 'keyword_id' => 12]);

        $this->when(function () {
            $this->setAuthUser(User::find(1));
            $this->setInputParameter('keyword_id', 13);

            $this->runService();

            $this->assertResultWithPersisting(new UserKeyword([
                UserKeyword::USER_ID => 1,
                UserKeyword::KEYWORD_ID => 13,
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
        Drink::factory()->create(['id' => 11, 'type' => 'aaa']);
        Drink::factory()->create(['id' => 12, 'type' => 'bbb']);

        $this->when(function () {
            $this->setInputParameter('keyword_id', 13);

            $this->runService();

            $this->assertError('drink keyword for [keyword_id] must exist.');
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
