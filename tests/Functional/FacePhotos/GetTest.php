<?php

namespace Tests\Functional\FacePhotos;

use App\Database\Models\User;
use App\Database\Models\FacePhoto;
use Tests\Functional\_TestCase;

class GetTest extends _TestCase {

    protected $uri = 'api/face-photos';

    public function test()
    {
        $this->factory(User::class)->create(['id' => 1]);
        $this->factory(User::class)->create(['id' => 2]);
        $this->factory(FacePhoto::class)->create(['id' => 11, 'user_id' => 1]);
        $this->factory(FacePhoto::class)->create(['id' => 12, 'user_id' => 1]);
        $this->factory(FacePhoto::class)->create(['id' => 13, 'user_id' => 2]);
        $this->factory(FacePhoto::class)->create(['id' => 14, 'user_id' => 2]);

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
