<?php

namespace Tests\Functional\SelfKeyword;

use App\Models\Keyword\Career;
use App\Models\User;
use App\Models\UserSelfKwdPvt;
use Tests\Functional\_TestCase;

/**
 * @internal
 * @coversNothing
 */
class CareersPostTest extends _TestCase
{
    protected $uri = 'api/self-keyword/careers';

    public function test()
    {
        $this->factory(User::class)->create(['id' => 1]);
        $this->factory(User::class)->create(['id' => 2]);
        $this->factory(Career::class)->create(['id' => 11]);
        $this->factory(Career::class)->create(['id' => 12]);
        $this->factory(Career::class)->create(['id' => 13]);
        $this->factory(UserSelfKwdPvt::class)->create(['id' => 101, 'user_id' => 1, 'keyword_id' => 11]);
        $this->factory(UserSelfKwdPvt::class)->create(['id' => 102, 'user_id' => 1, 'keyword_id' => 12]);
        $this->factory(UserSelfKwdPvt::class)->create(['id' => 104, 'user_id' => 2, 'keyword_id' => 12]);

        $this->when(function () {
            $this->setAuthUser(User::find(1));
            $this->setInputParameter('keyword_id', 13);

            $this->assertResultWithPersisting(new UserSelfKwdPvt([
                UserSelfKwdPvt::USER_ID => 1,
                UserSelfKwdPvt::KEYWORD_ID => 13,
            ]));
            $this->assertEquals(
                0,
                UserSelfKwdPvt::query()
                    ->where(UserSelfKwdPvt::USER_ID, 1)
                    ->whereIn(UserSelfKwdPvt::KEYWORD_ID, [11, 12])
                    ->count()
            );
            $this->assertEquals(
                1,
                UserSelfKwdPvt::query()
                    ->where(UserSelfKwdPvt::USER_ID, 2)
                    ->where(UserSelfKwdPvt::KEYWORD_ID, 12)
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

    public function testErrorNotNullRuleKeywordModel()
    {
        $this->factory(Career::class)->create(['id' => 11]);
        $this->factory(Career::class)->create(['id' => 12]);

        $this->when(function () {
            $this->setInputParameter('keyword_id', 13);

            $this->assertError('career keyword for [keyword_id] must exist.');
        });
    }
}
