<?php

namespace Tests\Functional\CardGroups;

use App\Models\CardGroup;
use App\Models\User;
use Tests\Functional\_TestCase;

/**
 * @internal
 * @coversNothing
 */
class GetTest extends _TestCase
{
    protected $uri = 'card-groups';

    public function test()
    {
        User::factory()->create(['id' => 1]);
        User::factory()->create(['id' => 2]);
        CardGroup::factory()->create(['id' => 11, 'user_id' => 1]);
        CardGroup::factory()->create(['id' => 12, 'user_id' => 2, 'created_at' => '1970-01-01 00:00:01']);
        CardGroup::factory()->create(['id' => 13, 'user_id' => 2]);
        CardGroup::factory()->create(['id' => 14, 'user_id' => 1]);

        $this->when(function () {
            $this->setAuthUser(User::find(1));
            $this->setInputParameter('after', (new \DateTime('1999-01-01'))->format('Y-m-d H:i:s'));
            $this->setInputParameter('timezone', 'Asia/Seoul');

            $this->runService();

            $this->assertResultWithListing([11, 14]);
        });

        $this->when(function () {
            $this->setAuthUser(User::find(2));
            $this->setInputParameter('after', (new \DateTime('1999-01-01'))->format('Y-m-d H:i:s'));
            $this->setInputParameter('timezone', 'Asia/Seoul');

            $this->runService();

            $this->assertResultWithListing([13]);
        });
    }

    public function testErrorRequiredRuleAuthUser()
    {
        $this->when(function () {
            $this->runService();

            $this->assertError('header[authorization] is required.');
        });
    }
}
