<?php

namespace Tests\Unit\App\Http\Controllers\Api\SelfKeyword;

use App\Database\Models\User;
use App\Services\UserSelfKwdPvt\SmokeUserSelfKwdPvtUpdatingService;
use Tests\Unit\App\Http\Controllers\Api\_TestCase;

class SmokeControllerTest extends _TestCase {

    public function testUpdate()
    {
        $authUser  = $this->factory(User::class)->make();
        $keywordId = $this->uniqueString();

        $this->setAuthUser($authUser);
        $this->setInputParameter('keyword_id', $keywordId);

        $this->assertReturn([SmokeUserSelfKwdPvtUpdatingService::class, [
            'auth_user'
                => $authUser,
            'keyword_id'
                => $keywordId
        ], [
            'auth_user'
                => 'authorized user',
            'keyword_id'
                => '[keyword_id]'
        ]]);
    }

}
