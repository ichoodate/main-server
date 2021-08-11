<?php

namespace Tests\Functional\FacePhotos;

use App\Models\FacePhoto;
use App\Models\User;
use Tests\Functional\_TestCase;

/**
 * @internal
 * @coversNothing
 */
class PostTest extends _TestCase
{
    protected $uri = 'api/face-photos';

    public function test()
    {
        $this->factory(User::class)->create(['id' => 1]);
        $this->factory(User::class)->create(['id' => 2]);
        $this->factory(FacePhoto::class)->create(['id' => 11, 'user_id' => 1]);

        $this->when(function () {
            $this->setAuthUser(User::find(1));
            $this->setInputParameter('upload', 'iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mNkYPj/HwADBwIAMCbHYQAAAABJRU5ErkJggg==');

            $this->assertResultWithPersisting(new FacePhoto([
                'user_id' => 1,
                'data' => 'iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mNkYPj/HwADBwIAMCbHYQAAAABJRU5ErkJggg==',
            ]));
        });
    }

    public function testErrorBase64ImageRuleUpload()
    {
        $this->factory(User::class)->create(['id' => 1]);

        $this->when(function () {
            $this->setAuthUser(User::find(1));
            $this->setInputParameter('upload', 'asiudfh9w=8uihf');

            $this->assertError('[upload] must to be base64 image string.');
        });
    }

    public function testErrorRequiredRuleAuthUser()
    {
        $this->when(function () {
            $this->assertError('authorized user is required.');
        });
    }

    public function testErrorRequiredRuleUpload()
    {
        $this->when(function () {
            $this->assertError('[upload] is required.');
        });
    }
}
