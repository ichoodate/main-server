<?php

namespace Tests\Unit\App\Http\Controllers\Api\SelfKeyword;

use App\Database\Models\User;
use App\Services\UserSelfKwdPvt\HobbyUserSelfKwdPvtCreatingService;
use Tests\Unit\App\Http\Controllers\Api\_TestCase;

class HobbyControllerTest extends _TestCase {

    public function testStore()
    {
        $authUser   = $this->setAuthUser();
        $keywordIds = $this->setInputParameter('keyword_ids');

        $this->assertReturn([HobbyUserSelfKwdPvtCreatingService::class, [
            'auth_user'
                => $authUser,
            'keyword_ids'
                => $keywordIds
        ], [
            'auth_user'
                => 'authorized user',
            'keyword_ids'
                => '[keyword_ids]'
        ]]);
    }

}
