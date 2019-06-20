<?php

namespace Tests\Unit\App\Http\Controllers\Api;

use App\Database\Models\User;
use App\Services\FacePhoto\FacePhotoFindingService;
use App\Services\FacePhoto\FacePhotoListingService;
use App\Services\FacePhoto\FacePhotoUpdatingService;
use Tests\Unit\App\Http\Controllers\Api\_TestCase;

class FacePhotoControllerTest extends _TestCase {

    public function testIndex()
    {
        $authUser = $this->factory(User::class)->make();
        $expands  = $this->uniqueString();
        $fields   = $this->uniqueString();

        $this->setAuthUser($authUser);
        $this->setInputParameter('expands', $expands);
        $this->setInputParameter('fields', $fields);

        $this->assertReturn([FacePhotoListingService::class, [
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

    public function testShow()
    {
        $authUser = $this->factory(User::class)->make();
        $expands  = $this->uniqueString();
        $fields   = $this->uniqueString();
        $id       = $this->uniqueString();

        $this->setAuthUser($authUser);
        $this->setInputParameter('expands', $expands);
        $this->setInputParameter('fields', $fields);
        $this->setRouteParameter('id', $id);

        $this->assertReturn([FacePhotoFindingService::class, [
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
        $authUser = $this->factory(User::class)->make();
        $upload   = $this->uniqueString();

        $this->setAuthUser($authUser);
        $this->setInputParameter('upload', $upload);

        $this->assertReturn([FacePhotoUpdatingService::class, [
            'auth_user'
                => $authUser,
            'upload'
                => $upload,
        ], [
            'auth_user'
                => 'authorized user',
            'upload'
                => '[upload]'
        ]]);
    }

}
