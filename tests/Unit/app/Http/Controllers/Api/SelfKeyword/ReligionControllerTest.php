<?php

namespace Tests\Unit\App\Http\Controllers\Api\SelfKeyword;

use App\Database\Models\User;
use App\Services\UserSelfKwdPvt\ReligionUserSelfKwdPvtCreatingService;
use Tests\Unit\App\Http\Controllers\Api\_TestCase;

class ReligionControllerTest extends _TestCase {

    public function testUpdate()
    {
        $authUser  = $this->setAuthUser();
        $keywordId = $this->setInputParameter('keyword_id');

        $this->assertReturn([ReligionUserSelfKwdPvtCreatingService::class, [
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
