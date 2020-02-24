<?php

namespace Tests\Unit\App\Http\Controllers\Api\IdealTypeKeyword;

use App\Database\Models\User;
use App\Services\UserIdealTypeKwdPvt\HobbyUserIdealTypeKwdPvtCreatingService;
use Tests\Unit\App\Http\Controllers\Api\_TestCase;

class HobbyControllerTest extends _TestCase {

    public function testUpdate()
    {
        $authUser  = $this->factory(User::class)->make();
        $keywordIds = $this->uniqueString();

        $this->setAuthUser($authUser);
        $this->setInputParameter('keyword_ids', $keywordIds);

        $this->assertReturn([HobbyUserIdealTypeKwdPvtCreatingService::class, [
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
