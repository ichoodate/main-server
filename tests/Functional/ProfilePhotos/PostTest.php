<?php

namespace Tests\Functional\ProfilePhotos;

use App\Database\Models\User;
use App\Database\Models\ProfilePhoto;
use Tests\Functional\_TestCase;

class PostTest extends _TestCase {

    protected $uri = 'api/profile-photos';

    public function test()
    {
        $this->factory(User::class)->create(['id' => 1]);

        $this->when(function () {

            $this->setAuthUser(User::find(1));
            $this->setInputParameter('user_id', 1);
            $this->setInputParameter('upload', 'iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mP8/x8AAwMCAO+ip1sAAAAASUVORK5CYII=');

            $this->assertResultWithPersisting(new ProfilePhoto([
                'user_id' => 1,
                'data' => 'iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mP8/x8AAwMCAO+ip1sAAAAASUVORK5CYII='
            ]));
        });
    }

    public function testErrorBase64ImageRuleUpload()
    {
        $this->when(function () {

            $this->setInputParameter('upload', 'abcdef');

            $this->assertError('[upload] must to be base64 encoded string.');
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
