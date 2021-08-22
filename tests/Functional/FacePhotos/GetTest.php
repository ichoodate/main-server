<?php

namespace Tests\Functional\FacePhotos;

use App\Models\FacePhoto;
use App\Models\User;
use Tests\Functional\_TestCase;

/**
 * @internal
 * @coversNothing
 */
class GetTest extends _TestCase
{
    protected $uri = 'face-photos';

    public function test()
    {
        User::factory()->create(['id' => 1]);
        User::factory()->create(['id' => 2]);
        FacePhoto::factory()->create(['id' => 11, 'user_id' => 1]);
        FacePhoto::factory()->create(['id' => 12, 'user_id' => 1]);
        FacePhoto::factory()->create(['id' => 13, 'user_id' => 2]);
        FacePhoto::factory()->create(['id' => 14, 'user_id' => 2]);

        $this->when(function () {
            $this->setAuthUser(User::find(1));

            $this->assertResultWithListing([11, 12]);
        });

        $this->when(function () {
            $this->setAuthUser(User::find(2));

            $this->assertResultWithListing([13, 14]);
        });
    }

    public function testErrorRequiredRuleAuthUser()
    {
        $this->when(function () {
            $this->assertError('authorized user is required.');
        });
    }
}
