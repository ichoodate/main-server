<?php

namespace Tests\Functional\ChattingContents;

use App\Models\ChattingContent;
use App\Models\Friend;
use App\Models\Matching;
use App\Models\User;
use Tests\Functional\_TestCase;

/**
 * @internal
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
        ChattingContent::factory()->create(['id' => 21, 'writer_id' => 1, 'match_id' => 11]);
        ChattingContent::factory()->create(['id' => 22, 'writer_id' => 2, 'match_id' => 11]);
        ChattingContent::factory()->create(['id' => 23, 'writer_id' => 1, 'match_id' => 12]);
        ChattingContent::factory()->create(['id' => 24, 'writer_id' => 3, 'match_id' => 12]);
        ChattingContent::factory()->create(['id' => 25, 'writer_id' => 1, 'match_id' => 13]);
        ChattingContent::factory()->create(['id' => 26, 'writer_id' => 4, 'match_id' => 13]);
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
            $this->setInputParameter('type', 'friend');

            $this->runService();

            $this->assertResultWithListing([25, 26]);
        });
    }

    public function testErrorRequiredRuleAuthUser()
    {
        User::factory()->create(['id' => 1, 'gender' => User::GENDER_MAN]);

        $this->when(function () {
            $this->setAuthUser(User::find(1));

            $this->runService();

            $this->assertError('[match_id] is required when [type] is not present.');
        });
    }
}
