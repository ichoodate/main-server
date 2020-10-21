<?php

namespace Tests\Unit\App\Http\Controllers\Api\IdealTypeKeyword;

use App\Database\Models\User;
use App\Services\UserIdealTypeKwdPvt\StatureRangeUserIdealTypeKwdPvtCreatingService;
use Tests\Unit\App\Http\Controllers\Api\_TestCase;

class StatureRangeControllerTest extends _TestCase {

    public function testUpdate()
    {
        $authUser  = $this->setAuthUser();
        $keywordId = $this->setInputParameter('keyword_id');

        $this->assertReturn([StatureRangeUserIdealTypeKwdPvtCreatingService::class, [
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
