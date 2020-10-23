<?php

namespace Tests\Unit\App\Http\Controllers\Api;

use App\Database\Models\User;
use App\Services\Friend\FriendFindingService;
use App\Services\Friend\FriendCreatingService;
use Tests\Unit\App\Http\Controllers\Api\_TestCase;

class FriendControllerTest extends _TestCase {

    public function testShow()
    {
        $authUser = $this->setAuthUser();
        $expands  = $this->setInputParameter('expands');
        $fields   = $this->setInputParameter('fields');
        $id       = $this->setRouteParameter('friend');

        $this->assertReturn([FriendFindingService::class, [
            'auth_user'
                => $authUser,
            'expands'
                => $expands,
            'fields'
                => $fields,
            'id'
                => $id,
        ], [
            'auth_user'
                => 'authorized user',
            'expands'
                => '[expands]',
            'fields'
                => '[fields]',
            'id'
                => $id,
        ]]);
    }

    public function testStore()
    {
        $authUser = $this->setAuthUser();
        $matchId  = $this->setInputParameter('match_id');

        $this->assertReturn([FriendCreatingService::class, [
            'auth_user'
                => $authUser,
            'match_id'
                => $matchId,
        ], [
            'auth_user'
                => 'authorized user',
            'match_id'
                => '[match_id]'
        ]]);
    }

}
