<?php

namespace Tests\Functional\ProfilePhotos;

use App\Models\ProfilePhoto;
use App\Models\User;
use Tests\Functional\_TestCase;

/**
 * @internal
 * @coversNothing
 */
class PostTest extends _TestCase
{
    protected $uri = 'profile-photos';

    public function test()
    {
        User::factory()->create(['id' => 1]);

        $this->when(function () {
            $this->setAuthUser(User::find(1));
            $this->setInputParameter('data', ['data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mNkYPj/HwADBwIAMCbHYQAAAABJRU5ErkJggg==']);

            $this->runService();

            $this->assertResultWithPersisting(collect([new ProfilePhoto([
                'user_id' => 1,
                'data' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mNkYPj/HwADBwIAMCbHYQAAAABJRU5ErkJggg==',
            ])]));
        });
    }

    public function testErrorBase64ImageRuleUpload()
    {
        $this->when(function () {
            $this->setInputParameter('data', ['abcdef']);

            $this->runService();

            $this->assertError('[data][0] is not base64 image string or unsupported mime type.');
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
