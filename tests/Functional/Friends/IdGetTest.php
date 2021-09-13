<?php

namespace Tests\Functional\FacePhotos;

use App\Models\Friend;
use App\Models\Match;
use App\Models\User;
use Tests\Functional\_TestCase;

/**
 * @internal
 * @coversNothing
 */
class IdGetTest extends _TestCase
{
    protected $uri = 'friends/{id}';

    public function test()
    {
        User::factory()->create(['id' => 1, 'gender' => User::GENDER_MAN]);
        User::factory()->create(['id' => 2, 'gender' => User::GENDER_WOMAN]);
        Match::factory()->create(['id' => 11, 'man_id' => 1, 'woman_id' => 2]);
        Friend::factory()->create(['id' => 21, 'match_id' => 11, 'sender_id' => 1, 'receiver_id' => 2]);

        $this->when(function () {
            $this->setAuthUser(User::find(1));
            $this->setRouteParameter('id', 21);

            $this->runService();

            $this->assertResultWithFinding(21);
        });
    }

    public function testErrorIntegerRuleId()
    {
        $this->when(function () {
            $this->setRouteParameter('id', 'abcd');

            $this->runService();

            $this->assertError('abcd must be an integer.');
        });
    }

    public function testErrorNotNullRuleModel()
    {
        Friend::factory()->create(['id' => 11]);
        Friend::factory()->create(['id' => 12]);

        $this->when(function () {
            $this->setRouteParameter('id', 13);

            $this->runService();

            $this->assertError('friend for 13 must exist.');
        });
    }
}
