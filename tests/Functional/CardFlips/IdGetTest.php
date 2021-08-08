<?php

namespace Tests\Functional\Activities;

use App\Database\Models\CardFlip;
use App\Database\Models\User;
use Tests\Functional\_TestCase;

/**
 * @internal
 * @coversNothing
 */
class IdGetTest extends _TestCase
{
    protected $uri = 'api/card-flips/{id}';

    public function test()
    {
        $this->factory(User::class)->create(['id' => 1]);
        $this->factory(User::class)->create(['id' => 2]);
        $this->factory(CardFlip::class)->create(['id' => 11, 'user_id' => 1]);
        $this->factory(CardFlip::class)->create(['id' => 12, 'user_id' => 2]);

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
        $this->factory(CardFlip::class)->create(['id' => 11]);
        $this->factory(CardFlip::class)->create(['id' => 12]);

        $this->when(function () {
            $this->setRouteParameter('id', 13);

            $this->assertError('card_flip for 13 must exist.');
        });
    }

    public function testErrorRequiredRuleAuthUser()
    {
        $this->factory(CardFlip::class)->create(['id' => 11, 'user_id' => 1]);
        $this->when(function () {
            $this->assertError('authorized user is required.');
        });
    }

    public function testErrorRequiredRulePermittedUser()
    {
        $this->factory(User::class)->create(['id' => 1]);
        $this->factory(User::class)->create(['id' => 2]);
        $this->factory(CardFlip::class)->create(['id' => 11, 'user_id' => 1]);
        $this->factory(CardFlip::class)->create(['id' => 12, 'user_id' => 2]);

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
