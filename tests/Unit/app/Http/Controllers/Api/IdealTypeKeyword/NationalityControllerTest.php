<?php

namespace Tests\Unit\App\Http\Controllers\Api\IdealTypeKeyword;

use App\Database\Models\User;
use App\Services\UserIdealTypeKwdPvt\NationalityUserIdealTypeKwdPvtUpdatingService;
use Tests\Unit\App\Http\Controllers\Api\_TestCase;

class NationalityControllerTest extends _TestCase {

    public function testUpdate()
    {
        $authUser  = $this->factory(User::class)->make();
        $keywordId = $this->uniqueString();

        $this->setAuthUser($authUser);
        $this->setInputParameter('keyword_id', $keywordId);

        $this->assertReturn([NationalityUserIdealTypeKwdPvtUpdatingService::class, [
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
