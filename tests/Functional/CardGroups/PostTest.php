<?php

namespace Tests\Functional\CardGroups;

use App\Models\CardGroup;
use App\Models\IdealTypeKeyword;
use App\Models\Keyword\Religion;
use App\Models\User;
use App\Models\UserKeyword;
use Tests\Functional\_TestCase;

/**
 * @internal
 * @coversNothing
 */
class PostTest extends _TestCase
{
    protected $uri = 'card-groups';

    public function test()
    {
        User::factory()->create(['id' => 1, 'gender' => User::GENDER_MAN]);
        User::factory()->create(['id' => 2, 'gender' => User::GENDER_WOMAN]);
        User::factory()->create(['id' => 3, 'gender' => User::GENDER_WOMAN]);
        User::factory()->create(['id' => 4, 'gender' => User::GENDER_WOMAN]);
        User::factory()->create(['id' => 5, 'gender' => User::GENDER_WOMAN]);
        IdealTypeKeyword::factory()->create(['id' => 11, 'user_id' => 1, 'keyword_id' => 101]);
        UserKeyword::factory()->create(['id' => 12, 'user_id' => 2, 'keyword_id' => 101]);
        UserKeyword::factory()->create(['id' => 13, 'user_id' => 3, 'keyword_id' => 101]);
        UserKeyword::factory()->create(['id' => 14, 'user_id' => 4, 'keyword_id' => 101]);
        UserKeyword::factory()->create(['id' => 15, 'user_id' => 5, 'keyword_id' => 101]);
        Religion::factory()->create(['id' => 101, 'type' => 'irreligion']);

        $this->when(function () {
            CardGroup::where('user_id', 1)->delete();
            $this->setAuthUser(User::find(1));
            $this->setInputParameter('type', 'daily');
            $this->setInputParameter('timezone', 'Asia/Seoul');

            $this->runService();

            $this->assertResultWithPersisting(new CardGroup([
                'user_id' => 1,
                'type' => 'daily',
            ]));
        });
    }

    public function testErrorRequiredRuleAuthUser()
    {
        $this->when(function () {
            $this->setInputParameter('type', 'daily');

            $this->runService();

            $this->assertError('header[authorization] is required.');
        });
    }

    public function testErrorRequiredRuleTimezone()
    {
        $this->when(function () {
            $this->setInputParameter('type', 'daily');

            $this->runService();

            $this->assertError('[timezone] is required.');
        });
    }
}
