<?php

namespace Tests\Unit\App\Http\Controllers\Api;

use App\Database\Models\User;
use App\Services\UserIdealTypeKwdPvt\UserIdealTypeKwdPvtListingService;
use Tests\Unit\App\Http\Controllers\Api\_TestCase;

class IdealTypeKeywordControllerTest extends _TestCase {

    public function testIndex()
    {
        $authUser = $this->factory(User::class)->make();
        $expands  = $this->uniqueString();
        $fields   = $this->uniqueString();

        $this->setAuthUser($authUser);
        $this->setInputParameter('expands', $expands);
        $this->setInputParameter('fields', $fields);

        $this->assertReturn([UserIdealTypeKwdPvtListingService::class, [
            'auth_user'
                => $authUser,
            'expands'
                => $expands,
            'fields'
                => $fields,
            'group_by'
                => new \stdClass,
            'order_by'
                => new \stdClass
        ], [
            'auth_user'
                => 'authorized user',
            'expands'
                => '[expands]',
            'fields'
                => '[fields]',
            'group_by'
                => '[group_by]',
            'order_by'
                => '[order_by]'
        ]]);
    }

}
