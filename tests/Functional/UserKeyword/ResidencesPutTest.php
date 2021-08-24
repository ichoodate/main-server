<?php

namespace Tests\Functional\UserKeyword;

use App\Models\Keyword\Residence;
use App\Models\User;
use App\Models\UserKeyword;
use Tests\Functional\_TestCase;

/**
 * @internal
 * @coversNothing
 */
class ResidencesPutTest extends _TestCase
{
    protected $uri = 'self-keyword/residence-countries';

    public function test()
    {
        User::factory()->create(['id' => 1]);
        User::factory()->create(['id' => 2]);
        Residence::factory()->create(['id' => 11]);
        Residence::factory()->create(['id' => 12]);
        Residence::factory()->create(['id' => 13]);
        UserKeyword::factory()->create(['id' => 101, 'user_id' => 1, 'keyword_id' => 11]);
        UserKeyword::factory()->create(['id' => 102, 'user_id' => 1, 'keyword_id' => 12]);
        UserKeyword::factory()->create(['id' => 104, 'user_id' => 2, 'keyword_id' => 12]);

        $this->when(function () {
            $this->setAuthUser(User::find(1));
            $this->setInputParameter('keyword_id', 13);

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

            $this->assertError('[keyword_id] must be an integer.');
        });
    }

    public function testErrorNotNullRuleKeywordModel()
    {
        Residence::factory()->create(['id' => 11]);
        Residence::factory()->create(['id' => 12]);

        $this->when(function () {
            $this->setInputParameter('keyword_id', 13);

            $this->assertError('residence_country keyword for [keyword_id] must exist.');
        });
    }

    public function testErrorRequiredRuleAuthUser()
    {
        $this->when(function () {
            $this->assertError('authorized user is required.');
        });
    }

    public function testErrorRequiredRuleKeywordId()
    {
        $this->when(function () {
            $this->assertError('[keyword_id] is required.');
        });
    }
}
