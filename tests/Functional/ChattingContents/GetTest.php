<?php

namespace Tests\Functional\ChattingContents;

use App\Models\ChattingContent;
use App\Models\Match;
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
        Match::factory()->create(['id' => 101, 'man_id' => 1, 'woman_id' => 2]);
        Match::factory()->create(['id' => 102, 'man_id' => 3, 'woman_id' => 2]);
        ChattingContent::factory()->create(['id' => 11, 'writer_id' => 1, 'match_id' => 101]);
        ChattingContent::factory()->create(['id' => 12, 'writer_id' => 2, 'match_id' => 101]);
        ChattingContent::factory()->create(['id' => 13, 'writer_id' => 1, 'match_id' => 102]);
        ChattingContent::factory()->create(['id' => 14, 'writer_id' => 3, 'match_id' => 102]);

        $this->when(function () {
            $this->setAuthUser(User::find(1));
            $this->setInputParameter('match_id', 101);

            $this->runService();

            $this->assertResultWithListing([11, 12]);
        });

        $this->when(function () {
            $this->setAuthUser(User::find(2));
            $this->setInputParameter('match_id', 102);

            $this->runService();

            $this->assertResultWithListing([13, 14]);
        });
    }

    public function testErrorRequiredRuleAuthUser()
    {
        User::factory()->create(['id' => 1, 'gender' => User::GENDER_MAN]);

        $this->when(function () {
            $this->setAuthUser(User::find(1));

            $this->runService();

            $this->assertError('[match_id] is required.');
        });
    }
}
