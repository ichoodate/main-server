<?php

namespace Tests\Functional\CardGroups;

use App\Models\CardGroup;
use App\Models\User;
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
