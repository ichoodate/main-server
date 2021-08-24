<?php

namespace Tests\Functional\CardFlips;

use App\Models\CardFlip;
use App\Models\User;
use Tests\Functional\_TestCase;

/**
 * @internal
 * @coversNothing
 */
class IdGetTest extends _TestCase
{
    protected $uri = 'card-flips/{id}';

    public function test()
    {
        User::factory()->create(['id' => 1]);
        User::factory()->create(['id' => 2]);
        CardFlip::factory()->create(['id' => 11, 'user_id' => 1]);
        CardFlip::factory()->create(['id' => 12, 'user_id' => 2]);

        $this->when(function () {
            $this->setAuthUser(User::find(1));
            $this->setRouteParameter('id', 11);
            $this->assertResultWithFinding(11);
        });

        $this->when(function () {
            $this->setAuthUser(User::find(2));
            $this->setRouteParameter('id', 12);
            $this->assertResultWithFinding(12);
        });
    }

    public function testErrorIntegerRuleId()
    {
        $this->when(function () {
            $this->setRouteParameter('id', 'abcd');

            $this->assertError('abcd must be an integer.');
        });
    }

    public function testErrorNotNullRuleModel()
    {
        CardFlip::factory()->create(['id' => 11]);
        CardFlip::factory()->create(['id' => 12]);

        $this->when(function () {
            $this->setRouteParameter('id', 13);

            $this->assertError('card_flip for 13 must exist.');
        });
    }

    public function testErrorRequiredRuleAuthUser()
    {
        CardFlip::factory()->create(['id' => 11, 'user_id' => 1]);
        $this->when(function () {
            $this->assertError('header[authorization] is required.');
        });
    }

    public function testErrorRequiredRulePermittedUser()
    {
        User::factory()->create(['id' => 1]);
        User::factory()->create(['id' => 2]);
        CardFlip::factory()->create(['id' => 11, 'user_id' => 1]);
        CardFlip::factory()->create(['id' => 12, 'user_id' => 2]);

        $this->when(function () {
            $this->setAuthUser(User::find(2));

            $this->setRouteParameter('id', 11);

            $this->assertError('authorized user who is related user of card_flip for 11 is required.');
        });

        $this->when(function () {
            $this->setAuthUser(User::find(1));

            $this->setRouteParameter('id', 12);

            $this->assertError('authorized user who is related user of card_flip for 12 is required.');
        });
    }
}
