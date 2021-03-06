<?php

namespace Tests\Functional\ProfilePhotos;

use App\Models\ProfilePhoto;
use App\Models\User;
use Tests\Functional\_TestCase;

/**
 * @internal
 * @coversNothing
 */
class GetTest extends _TestCase
{
    protected $uri = 'profile-photos';

    public function test()
    {
        User::factory()->create(['id' => 1]);
        User::factory()->create(['id' => 2]);
        ProfilePhoto::factory()->create(['id' => 11, 'user_id' => 1]);
        ProfilePhoto::factory()->create(['id' => 12, 'user_id' => 2]);
        ProfilePhoto::factory()->create(['id' => 13, 'user_id' => 2]);
        ProfilePhoto::factory()->create(['id' => 14, 'user_id' => 1]);

        $this->when(function () {
            $this->setInputParameter('user_id', 1);

            $this->runService();

            $this->assertResultWithListing([11, 14]);
        });

        $this->when(function () {
            $this->setInputParameter('user_id', 2);

            $this->runService();

            $this->assertResultWithListing([12, 13]);
        });
    }

    public function testErrorRequiredRuleAuthUser()
    {
        $this->when(function () {
            $this->runService();

            $this->assertError('[user_id] is required.');
        });
    }
}
