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
    protected $uri = 'face-photos';

    public function test()
    {
        User::factory()->create(['id' => 1]);
        User::factory()->create(['id' => 2]);
        FacePhoto::factory()->create(['id' => 11, 'user_id' => 1]);

        $this->when(function () {
            $this->setAuthUser(User::find(1));
            $this->setInputParameter('data', 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mNkYPj/HwADBwIAMCbHYQAAAABJRU5ErkJggg==');

            $this->runService();

            $this->assertResultWithPersisting(new FacePhoto([
                'user_id' => 1,
                'data' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mNkYPj/HwADBwIAMCbHYQAAAABJRU5ErkJggg==',
            ]));
        });
    }

    public function testErrorBase64ImageRuleUpload()
    {
        User::factory()->create(['id' => 1]);

        $this->when(function () {
            $this->setAuthUser(User::find(1));
            $this->setInputParameter('data', 'asiudfh9w=8uihf');

            $this->runService();

            $this->assertError('[data] is not base64 image string or unsupported mime type.');
        });
    }

    public function testErrorRequiredRuleAuthUser()
    {
        $this->when(function () {
            $this->runService();

            $this->assertError('header[authorization] is required.');
        });
    }

    public function testErrorRequiredRuleUpload()
    {
        $this->when(function () {
            $this->runService();

            $this->assertError('[data] is required.');
        });
    }
}
