<?php

namespace Tests\Unit\App\Http\Controllers\Api;

use App\Database\Models\User;
use App\Services\FacePhoto\FacePhotoFindingService;
use App\Services\FacePhoto\FacePhotoListingService;
use App\Services\FacePhoto\FacePhotoCreatingService;
use Tests\Unit\App\Http\Controllers\Api\_TestCase;

class FacePhotoControllerTest extends _TestCase {

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
        $data     = $this->uniqueString();

        $this->setAuthUser($authUser);
        $this->setInputParameter('data', $data);

        $this->assertReturn([FacePhotoCreatingService::class, [
            'auth_user'
                => $authUser,
            'data'
                => $data,
        ], [
            'auth_user'
                => 'authorized user',
            'data'
                => '[data]',
        ]]);
    }

}
