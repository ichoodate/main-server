<?php

namespace Tests\Functional\ChattingContents;

use App\Models\ChattingContent;
use App\Models\Friend;
use App\Models\Matching;
use App\Models\User;
use Tests\Functional\_TestCase;

/**
 * @internal
 *
 * @coversNothing
 */
class GetTest extends _TestCase
{
    protected $uri = 'chatting-contents';

    public function test()
    {
        User::factory()->create(['id' => 1, 'gender' => User::GENDER_MAN]);
        User::factory()->create(['id' => 2, 'gender' => USER::GENDER_WOMAN]);
        User::factory()->create(['id' => 3, 'gender' => User::GENDER_MAN]);
        User::factory()->create(['id' => 4, 'gender' => USER::GENDER_WOMAN]);
        Matching::factory()->create(['id' => 11, 'man_id' => 1, 'woman_id' => 2]);
        Matching::factory()->create(['id' => 12, 'man_id' => 3, 'woman_id' => 2]);
        Matching::factory()->create(['id' => 13, 'man_id' => 1, 'woman_id' => 4]);
        ChattingContent::factory()->create(['id' => 21, 'sender_id' => 1, 'receiver_id' => 2, 'match_id' => 11, 'created_at' => '2011-01-11 00:00:00']);
        ChattingContent::factory()->create(['id' => 22, 'sender_id' => 2, 'receiver_id' => 1, 'match_id' => 11, 'created_at' => '2011-01-12 00:00:00']);
        ChattingContent::factory()->create(['id' => 23, 'sender_id' => 2, 'receiver_id' => 3, 'match_id' => 12]);
        ChattingContent::factory()->create(['id' => 24, 'sender_id' => 3, 'receiver_id' => 2, 'match_id' => 12]);
        ChattingContent::factory()->create(['id' => 25, 'sender_id' => 1, 'receiver_id' => 4, 'match_id' => 13, 'created_at' => '2011-01-11 00:00:00']);
        ChattingContent::factory()->create(['id' => 26, 'sender_id' => 4, 'receiver_id' => 1, 'match_id' => 13, 'created_at' => '2011-02-13 00:00:00']);
        ChattingContent::factory()->create(['id' => 27, 'sender_id' => 4, 'receiver_id' => 1, 'match_id' => 13, 'created_at' => '2011-01-12 00:00:00']);
        Friend::factory()->create(['id' => 31, 'match_id' => 13, 'sender_id' => 1, 'receiver_id' => 4]);

        $this->when(function () {
            $this->setAuthUser(User::find(1));
            $this->setInputParameter('match_id', 11);

            $this->runService();

            $this->assertResultWithListing([21, 22]);
        });

        $this->when(function () {
            $this->setAuthUser(User::find(2));
            $this->setInputParameter('match_id', 12);

            $this->runService();

            $this->assertResultWithListing([23, 24]);
        });

        $this->when(function () {
            $this->setAuthUser(User::find(1));
            $this->setInputParameter('group_by', 'match_id');

            $this->runService();

            $this->assertResultWithListing([22, 26]);
        });
    }

    public function testErrorRequiredRuleAuthUser()
    {
        $this->when(function () {
            $this->runService();

            $this->assertError('header[authorization] is required.');
        });
    }

    public function testErrorRequiredWithoutRuleGroupBy()
    {
        $this->when(function () {
            $this->runService();

            $this->assertError('[group_by] is required when [match_id] is not present.');
        });
    }

    public function testErrorSomeOfArrayRuleGroupBy()
    {
        $this->when(function () {
            $this->setInputParameter('group_by', 'abcd');
            $this->runService();

            $this->assertError('[group_by] must be some of available options for [group_by].');
        });
    }
}
