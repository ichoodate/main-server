<?php

namespace Tests\Functional\Api\Cards;

use App\Database\Models\Activity;
use App\Database\Models\Card;
use App\Database\Models\User;
use Tests\Functional\_TestCase;

class IdActivitiesGetTest extends _TestCase {

    protected $uri = 'api/cards/{id}/activities';

    public function test()
    {
        $this->factory(User::class)->create(['id' => 1]);
        $this->factory(User::class)->create(['id' => 2]);
        $this->factory(Card::class)->create(['id' => 11, 'chooser_id' => 1, 'showner_id' => 2]);
        $this->factory(Card::class)->create(['id' => 12, 'chooser_id' => 3, 'showner_id' => 4]);
        $this->factory(Activity::class)->create(['id' => 101, 'user_id' => 1, 'related_id' => 11]);
        $this->factory(Activity::class)->create(['id' => 102, 'user_id' => 2, 'related_id' => 11]);
        $this->factory(Activity::class)->create(['i3' => 103, 'user_id' => 3, 'related_id' => 12]);

        $this->when(function () {

            $this->setAuthUser(User::find(1));
            $this->setRouteParameter('id', 11);

            $this->assertResultWithListing([101, 102]);
        });

        $this->when(function () {

            $this->setAuthUser(User::find(2));
            $this->setRouteParameter('id', 11);

            $this->assertResultWithListing([101, 102]);
        });
    }

    public function testErrorIntegerRuleCardId()
    {
        $this->when(function () {

            $this->setRouteParameter('id', 'abcd');

            $this->assertError('abcd must be an integer.');
        });
    }

    public function testErrorNotNullRuleCardModel()
    {
        $this->factory(User::class)->create(['id' => 1]);
        $this->factory(User::class)->create(['id' => 2]);
        $this->factory(Card::class)->create(['id' => 11, 'chooser_id' => 1, 'showner_id' => 2]);

        $this->when(function () {

            $this->setAuthUser(User::find(1));
            $this->setRouteParameter('id', '12');

            $this->assertError('card for 12 must exist.');
        });
    }

    public function testErrorRequiredRuleAuthUser()
    {
        $this->when(function () {

            $this->assertError('authorized user is required.');
        });
    }

    public function testErrorRequiredRulePermittedUser()
    {
        $this->factory(User::class)->create(['id' => 3]);
        $this->factory(Card::class)->create(['id' => 11, 'chooser_id' => 1, 'showner_id' => 2]);

        $this->when(function () {

            $this->setAuthUser(User::find(3));
            $this->setRouteParameter('id', 11);

            $this->assertError('authorized user who is related user of card for 11 is required.');
        });
    }

}
