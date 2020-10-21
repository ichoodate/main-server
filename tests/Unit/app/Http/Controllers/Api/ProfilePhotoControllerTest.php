<?php

namespace Tests\Unit\App\Http\Controllers\Api;

use App\Database\Models\ProfilePhoto;
use App\Database\Models\User;
use App\Services\ProfilePhoto\ProfilePhotoFindingService;
use App\Services\ProfilePhoto\ProfilePhotoListingService;
use App\Services\ProfilePhoto\ProfilePhotoCreatingService;

class ProfilePhotoControllerTest extends _TestCase {

    public function testIndex()
    {
        $authUser = $this->setAuthUser();
        $cursorId = $this->setInputParameter('cursor_id');
        $expands  = $this->setInputParameter('expands');
        $fields   = $this->setInputParameter('fields');
        $limit    = $this->setInputParameter('limit');
        $page     = $this->setInputParameter('page');

        $this->assertReturn([ProfilePhotoListingService::class, [
            'user'
                => $authUser,
            'user_id'
                => $authUser->getKey(),
            'cursor_id'
                => $cursorId,
            'limit'
                => $limit,
            'page'
                => $page,
            'expands'
                => $expands,
            'fields'
                => $fields,
            'group_by'
                => '',
            'order_by'
                => ''
        ], [
            'user'
                => 'authorized user',
            'user_id'
                => 'id of authorized user',
            'cursor_id'
                => '[cursor_id]',
            'limit'
                => '[limit]',
            'page'
                => '[page]',
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

    public function testShow()
    {
        $authUser = $this->setAuthUser();
        $expands  = $this->setInputParameter('expands');
        $fields   = $this->setInputParameter('fields');
        $id       = $this->setRouteParameter('profile_photo');

        $this->assertReturn([ProfilePhotoFindingService::class, [
            'auth_user'
                => $authUser,
            'expands'
                => $expands,
            'fields'
                => $fields,
            'id'
                => $id
        ], [
            'auth_user'
                => 'authorized user',
            'expands'
                => '[expands]',
            'fields'
                => '[fields]',
            'id'
                => $id
        ]]);
    }

    public function testStore()
    {
        $authUser = $this->setAuthUser();
        $data     = $this->setInputParameter('data');

        $this->assertReturn([ProfilePhotoCreatingService::class, [
            'auth_user'
                => $authUser,
            'data'
                => $data
        ], [
            'auth_user'
                => 'authorized user',
            'data'
                => '[data]',
        ]]);
    }

}
