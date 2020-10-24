<?php

namespace Tests\Unit\App\Http\Controllers\Api\IdealTypeKeyword;

use App\Database\Models\User;
use App\Services\UserIdealTypeKwdPvt\WeightRangeUserIdealTypeKwdPvtCreatingService;
use Tests\Unit\App\Http\Controllers\Api\_TestCase;

class WeightRangeControllerTest extends _TestCase {

    public function testStore()
    {
        $authUser  = $this->setAuthUser();
        $keywordId = $this->setInputParameter('keyword_id');

        $this->assertReturn([WeightRangeUserIdealTypeKwdPvtCreatingService::class, [
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
